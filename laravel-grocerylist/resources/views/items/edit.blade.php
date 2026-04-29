@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
<h1>Item Bewerken</h1>
<form action="{{ route('items.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Naam:</label>
    <input type="text" id="name" name="name" value="{{ $item->name }}" required>
    <br>
    <label for="description">Beschrijving:</label>
    <textarea id="description" name="description">{{ $item->description }}</textarea>
    <br>
    <button type="submit">Bijwerken</button>
</form>
@endsection