@extends('layouts.app')

@section('title', $article->name)

@section('content')

@if(isset($edit))
@include('forms.edit')
@else
<div class="wrap">
    <div class="flex">
        <h1 class="h1 mb-1 mr-5">{{ $article->name }}</h1>
        <div class="flex gap-1">
            @foreach($article->categories->sortBy('name') as $category)
            <p class="wrap bg-green-200 px-2 py-1 round-1 text-sm font-semibold my-0">{{$category->name}}</p>
            @endforeach
        </div>
        <p class="text-xs ml-auto">{{ $article->created_at->format('d-m-Y H:i')}}</p>
    </div>
    <div class="flex">
        <p class="font-semibold mb-4">{{ $article->user->name }}</p>
    </div>
    <p>{!! nl2br(e($article->text)) !!}</p>
    @isset($article->image)
    <img src="{{Storage::url($article->image)}}" class="mx-auto my-4 rounded-xl shadow-lg">
    @endisset
    <div class="flex">
        <p class="text-xs mt-4">{{ count($article->comments) }} reacties</p>
        @can('update', $article)
        <span class="flex ml-auto">
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
        @endcan
    </div>
</div>

@foreach ($article->comments as $comment)
<div class="wrap">
    <div class="flex mb-2">
        <p class="font-semibold">{{ $comment->user->name }}</p>
        <span class="text-xs ml-auto">{{ $comment->created_at->format('d-m-Y H:i') }}</span>
    </div>
    <p>{!! nl2br(e($comment->text)) !!}</p>
    @can('delete', $comment)
    <span class="flex">
        <form action="{{ route('comments.destroy', [$article, $comment]) }}" method="POST" class="flex ml-auto" onsubmit="return confirm('Weet je het zeker? Deze actie kan niet ongedaan gemaakt worden')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-cancel">verwijderen</button>
        </form>
    </span>
    @endcan
</div>
@endforeach

<div class="my-4 bg-gray-100 rounded-xl shadow-md p-4" id="comment">
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
@endif
@endsection