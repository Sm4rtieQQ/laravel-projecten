@extends('layouts.app')

@section('title', auth()->user()->name)

@section('content')

@if(session('success'))
<span class="text-green-600 text-sm">{{session('success')}}</span>
@endif

<div class="grid grid-cols-2">
    <h1 class="h1">Welkom, {{ auth()->user()->name }}</h1>
    <div class="ml-auto">
        <div class="flex gap-2 items-center mb-4">
            <span class="text-sm">Account:</span>
            @if(auth()->user()->is_premium)
            <span class="wrap tag premium">premium</span>
            @else
            <span class="wrap tag">gratis</span>
            @endif
        </div>
        <a class="btn-neutral" href="{{route('shop')}}">Wijzig accounttype</a>
    </div>
</div>

<div class="pb-4">
    <h4 class="font-semibold">Mijn artikelen</h4>

    @if (auth()->user()->articles()->exists())
    @foreach(auth()->user()->articles->sortByDesc('created_at') as $article)
    <div class="wrap">
        <div class="flex">
            <h4 class="font-semibold mr-5">{{$article->name}}</h4>
            <div class="flex gap-1">
                @foreach($article->categories as $category)
                <span class="wrap bg-green-200 tag">{{$category->name}}</span>
                @endforeach
                @if($article->premium)
                <span class="wrap tag premium">premium</span>
                @endif
            </div>
            <span class="text-xs ml-auto">{{ $article->created_at->format('d-m-Y H:i') }}</span>
        </div>
        <p class="pb-2">{{ $article->text }}</p>
        @isset($article->image)
        <img src="{{Storage::url($article->image)}}" class="mx-auto my-4 w-100 rounded-xl shadow-lg">
        @endisset
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