@extends('layouts.app')

@section('title', 'Artikelen')

@section('content')
<h1 class="h1">Overzicht</h1>
<span class="text-sm italic">{{ count($articles) }} Artikelen gevonden</span>
@foreach($articles as $article)
<a href="{{ route('articles.show', $article->id) }}">
    <div class="wrap bg-green-200 hover:bg-green-300">
        <div class="flex">
            <h4 class="text-lg font-bold mb-1 mr-5">{{ $article->name }}</h4>
            <div class="flex gap-1">
                @foreach($article->categories as $category)
                <p class="wrap px-2 py-1 round-1 text-sm font-semibold my-0">{{$category->name}}</p>
                @endforeach
            </div>
            <span class="text-sm ml-auto">{{ $article->created_at->format('d-m-Y H:i') }}</span>
        </div>
        <div class="flex mb-1">
            <p>{{$article->user->name}}</p>
        </div>
        @isset($article->image)
        <img src="{{ Storage::url($article->image)}}" class="w-100 mx-auto rounded-xl shadow-lg">
        @endisset
        <span class="text-xs">{{ count($article->comments) }} reacties</span>
    </div>
</a>
@endforeach
@endsection