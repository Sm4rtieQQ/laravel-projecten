@extends('layouts.app')

@section('title', 'Bewerken')

@section('content')
<h1>Item Bewerken</h1>
<form action="{{ route('items.update', $item) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Naam:</label>
    <input type="text" id="name" name="name" value="{{ $item->name }}" required>
    <br>
    <label for="category">Categorie:</label>
    <select name="category_id" id="category" required>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </select>
    <label for="description">Beschrijving:</label>
    <textarea id="description" name="description">{{ $item->description }}</textarea>
    <br>
    <button type="submit">Bijwerken</button>
</form>
@endsection