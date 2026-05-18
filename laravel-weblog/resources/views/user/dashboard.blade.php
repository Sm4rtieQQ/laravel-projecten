@extends('layouts.app')

@section('title', auth()->user()->name)

@section('content')
<h1 class="h1">Welkom, {{ auth()->user()->name }}</h1>

<div class="pb-4">
    <h4 class="font-semibold">Mijn artikelen</h4>

    @if (auth()->user()->articles()->exists())
    @foreach(auth()->user()->articles as $article)
    <div class="wrap">
        <div class="flex">
            <h4 class="font-semibold">{{$article->name}}</h4>
            <span class="text-xs ml-auto">{{ $article->created_at->format('d-m-Y H:i') }}</span>
        </div>
        <p class="pb-2">{{ $article->text }}</p>
        <div class="flex">
            <span class="text-xs">{{ count($article->comments) }} reacties</span>
            <span class="flex ml-auto">
                <a href="{{ route('articles.show', $article->id) }}" class="btn-neutral">openen</a>
                <form action="{{ route('articles.edit', $article) }}" method="GET">
                    @csrf
                    <button type="submit" class="btn-neutral">bewerken</button>
                </form>
                <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Weet je het zeker? Deze actie kan niet ongedaan gemaakt worden')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-cancel">verwijderen</button>
                </form>
            </span>
        </div>
    </div>
    </a>
    @endforeach
    @else
    <p class="text-sm">Je hebt nog geen artikelen geplaatst.</p>
    @endif
</div>

<div>
    <h4 class="font-semibold">Mijn reacties</h4>

    @if (auth()->user()->comments()->exists())
    @foreach(auth()->user()->comments as $comment)
    <div class="wrap">
        <div class="flex mb-2">
            <p class="text-sm"> Mijn reactie onder "<span class="font-semibold">{{$comment->article->name}}</span>" door <span class="font-semibold">{{ $comment->article->user->name }}</span></p>
            <span class="text-xs ml-auto">{{ $comment->created_at->format('d-m-Y H:i') }}</span>
        </div>
        <p>{{ $comment->text }}</p>
        <div class="flex">
            <a href="{{ route('articles.show', $comment->article->id) }}" class="btn-neutral ml-auto">open artikel</a>
        </div>
    </div>
    @endforeach
    @else
    <p class="text-sm">Je hebt nog niet gereageerd.</p>
    @endif
</div>

@endsection