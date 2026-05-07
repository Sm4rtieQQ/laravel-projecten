@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
<div class="wrap">
    <div class="mb-5">
        <span class="text-xs italic">{{ $article->created_at->format('d-m-Y H:i')}}</span>
        <h1 class="h1">{{ $article->name }}</h1>
    </div>
    <p>{{ $article->text }}</p>
    <span class="text-xs">{{ count($article->comments) }} reacties</span>
</div>

@foreach ($article->comments as $comment)
<div class="wrap">
    <span class="text-xs">{{ $comment->created_at->format('d-m-Y H:i') }}</span>
    <p>{{ $comment->text }}</p>
</div>
@endforeach

<div class="my-4 bg-gray-100 rounded-xl shadow-md p-4">
    <h4 class="font-semibold">Neem deel aan het gesprek</h4>
    <form action="{{route('comments.store', $article)}}" method="POST">
        @csrf
        <textarea class="bg-white w-full h-64 my-4" name="newComment" id="newComment" type="text" required></textarea>
        <button class="btn-submit" type="submit">Plaats reactie</button>
    </form>
</div>
@endsection