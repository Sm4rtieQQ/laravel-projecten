@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
<div class="my-4 bg-gray-200 rounded-xl shadow-md p-4">
    <div class="mb-5">
        <span class="text-sm italic">{{ $article->created_at->format('d-m-Y H:i')}}</span>
        <h1 class="h1">{{ $article->name }}</h1>
    </div>
    <p>{{ $article->text }}</p>
</div>

<div class="my-4 bg-gray-100 rounded-xl shadow-md p-4">
    <h4 class="font-semibold">Neem deel aan het gesprek</h4>
    <textarea class="bg-white w-full h-64 my-4" name="newComment" id="newComment" type="text"></textarea>
    <button class="btn-submit">Plaats reactie</button>
</div>
@endsection