<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('public')->deleteDirectory('articles');
        Storage::disk('public')->makeDirectory('articles');

        $categories = Category::all();

        Article::factory(10)->create()->each(function ($article) use ($categories) {
            $article->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')
            );
        });
    }
}
