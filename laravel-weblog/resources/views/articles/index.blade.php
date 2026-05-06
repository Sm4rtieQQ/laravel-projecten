@extends('layouts.app')

@section('title', 'Overzicht')

@section('content')
<h1 class="h1">Overzicht</h1>
<span class="text-sm italic">{{ count($articles) }} Artikelen gevonden</span>
@foreach($articles as $article)
<a href="{{ route('articles.show', $article->id) }}">
    <div class=" my-6 p-4 bg-green-200 hover:bg-green-300 rounded-md shadow-lg">
        <h4 class="text-lg font-bold">{{ $article->name }}</h4>
        <span class="text-sm italic">{{ $article->created_at->format('d-m-Y H:i') }}</span>
    </div>
</a>
@endforeach
@endsection