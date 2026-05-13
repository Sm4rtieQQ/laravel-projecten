@extends('layouts.app')

@section('title', $article->name)

@section('content')

@if(isset($edit))
@include('articles.edit')
@else
<div class="wrap">
    <div class="flex">
        <h1 class="h1 mb-1">{{ $article->name }}</h1>
        <p class="text-xs ml-auto">{{ $article->created_at->format('d-m-Y H:i')}}</p>
    </div>
    <p class="font-semibold mb-4">{{ $article->user->name }}</p>
    <p>{{ $article->text }}</p>
    <div class="flex">
        <p class="text-xs">{{ count($article->comments) }} reacties</p>
        <span class="flex ml-auto">
            <form action="{{ route('articles.edit', $article) }}" method="GET">
                @csrf
                <button type="submit" class="btn-neutral">aanpassen</button>
            </form>
            <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Weet je het zeker? Deze actie kan niet ongedaan gemaakt worden')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-cancel">verwijderen</button>
            </form>
        </span>
    </div>
</div>
@endif

@foreach ($article->comments as $comment)
<div class="wrap">
    <div class="flex mb-2">
        <p class="font-semibold">{{ $comment->user->name }}</p>
        <span class="text-xs ml-auto">{{ $comment->created_at->format('d-m-Y H:i') }}</span>
    </div>
    <p>{{ $comment->text }}</p>
</div>
@endforeach

<div class="my-4 bg-gray-100 rounded-xl shadow-md p-4">
    @auth
    <h4 class="font-semibold">Neem deel aan het gesprek</h4>
    <form action="{{route('comments.store', $article)}}" method="POST">
        @csrf
        <textarea class="bg-white w-full h-32 my-4" name="newComment" id="newComment" type="text" required></textarea>
        <button class="btn-submit" type="submit">Plaats reactie</button>
    </form>
    @else
    <h4 class="font-semibold"><a href="{{route('login')}}" class="underline">Log in</a> om te reageren</h4>
    @endauth
</div>
@endsection