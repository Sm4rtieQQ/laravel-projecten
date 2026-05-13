@extends('layouts.app')

@section('title', 'Artikelen')

@section('content')
<h1 class="h1">Overzicht</h1>
<span class="text-sm italic">{{ count($articles) }} Artikelen gevonden</span>
@foreach($articles as $article)
<a href="{{ route('articles.show', $article->id) }}">
    <div class=" my-6 p-4 bg-green-200 hover:bg-green-300 rounded-md shadow-lg">
        <div class="flex">
            <h4 class="text-lg font-bold">{{ $article->name }}</h4>
            <span class="text-sm ml-auto">{{ $article->created_at->format('d-m-Y H:i') }}</span>
        </div>
        <p>{{$article->user->name}}</p>
        <span class="text-xs">{{ count($article->comments) }} reacties</span>
    </div>
</a>
@endforeach
@endsection