@extends('layouts.app')

@section('title', 'Nieuw artikel')

@section('content')
<h1 class="h1">Nieuw artikel aanmaken</h1>
<form action="{{route('articles.store')}}" method="POST">
    @csrf
    <div class="my-4 bg-gray-200 rounded-xl shadow-md">
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="name">Titel</label>
            <input class="bg-white w-11/12" name="name" id="name" type="text" required />
        </div>
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="text">Tekst</label>
            <textarea class="bg-white w-11/12 h-64" name="text" id="text" type="text" required></textarea>
        </div>
    </div>
    <button class="btn-submit" type="submit">Publiceer artikel</button>
    <a class="btn-cancel" href="{{ route('articles.index')}}">Annuleren</a>
</form>
@endsection