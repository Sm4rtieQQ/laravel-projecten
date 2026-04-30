@extends('layouts.app')

@section('title', 'Aanmaken')

@section('content')
<h1>Nieuw item aanmaken</h1>
<form action="{{route('items.store')}}" method="POST">
    @csrf
    <label for="name">Naam:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="category">Categorie:</label>
    <select name="category_id" id="category" required>
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <label for="description">Beschrijving:</label>
    <textarea id="description" name="description"></textarea>
    <br>
    <button type="submit">Opslaan</button>
</form>
@endsection