<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::getCategories();
        $selectedCategories = $request->input('categories', []);

        $articles = Article::orderBy('created_at', 'desc')
            ->when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
                foreach ($selectedCategories as $categoryId) {
                    $query->whereHas('categories', function ($query) use ($categoryId) {
                        $query->where('categories.id', $categoryId);
                    });
                }
            })
            ->when(!Auth::check() || !Auth::user()->is_premium, function ($query) {
                $query->where('premium', false);
            })
            ->get();


        return view('articles.index', compact('articles', 'categories', 'selectedCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $article = new Article();
        $newArticle = true;
        $categories = Category::getCategories();
        return view('articles.create', compact('article', 'newArticle', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        // image
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
        };

        // article
        $article = new Article();
        $article->fill([
            "name" => $request->input('name'),
            "text" => $request->input('text'),
            "image" => $path,
            "premium" => $request->boolean('premium'),
            "user_id" => Auth::id(),
        ]);
        $article->save();

        // category
        $categories = $request->input('categories', []);
        $article->categories()->attach($categories);

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        Gate::authorize('view', $article);

        $comments = $article->comments()->orderBy('created_at', 'desc');
        return view('articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        Gate::authorize('update', $article);

        $newArticle = false;
        $edit = true;
        $categories = Category::getCategories();
        $selectedCategories = $article->categories->pluck('id')->toArray();
        return view('articles.show', compact('article', 'newArticle', 'edit', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        Gate::authorize('update', $article);

        $articleData = [
            'name' => $request->input('name'),
            'text' => $request->input('text'),
            'premium' => $request->boolean('premium'),
        ];

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $articleData['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($articleData);

        $categories = $request->input('categories', []);
        $article->categories()->sync($categories);

        $newArticle = false;
        return view('articles.show', compact('article', 'newArticle'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);

        $article->comments()->delete();
        $article->delete();
        return redirect()->route('dashboard');
    }
}
