<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{

    //Display a listing of the resource.
    public function index()
    {
        $items = Item::with('category')->get();
        return view('items.index', compact('items'));
    }

    //Show the form for creating a new resource.
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    //Store a newly created resource in storage.
    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();

        Item::create($validated);

        return redirect()->route('items.index');
    }

    //Display the specified resource.
    public function show(string $id)
    {
        //
    }

    //Show the form for editing the specified resource.
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    //Update the specified resource in storage.
    public function update(UpdateItemRequest $request, Item $item)
    {
        $validated = $request->validated();

        $item->update($validated);

        return redirect()->route('items.index');
    }

    //Remove the specified resource from storage.
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index');
    }
}
