@extends('layouts.app')

@section('title', 'Artikelen')

@section('content')
<h1 class="h1">Overzicht</h1>

<!-- FILTERS -->
<div class="relative">
    <button class="btn-submit w-fit" id="filterToggle" type="button">Filters</button>

    <div id="filterPopup" class="hidden wrap absolute z-10 mt-2 p-4 w-80">
        <form action="{{ route('articles.index') }}" method="GET">
            <div class="flex flex-wrap">
                @foreach($categories as $category)
                <div class="m-1">
                    <input class="peer hidden" type="checkbox" name="categories[]" id="{{$category->id}}" value="{{$category->id}}" {{ in_array($category->id, $selectedCategories ?? []) ? 'checked' : '' }} />
                    <label for="{{$category->id}}" class="wrap tag cursor-pointer select-none bg-gray-200 peer-checked:bg-green-300">{{$category->name}}</label>
                </div>
                @endforeach
            </div>
            <div class="mt-3 flex gap-2">
                <button class="btn-submit" type="submit">Filter toepassen</button>
            </div>
        </form>
    </div>
    @if(!empty($selectedCategories))
    <a class="btn-cancel" href="{{ route('articles.index') }}">Filters verwijderen</a>
    @endif
</div>

<div class="flex gap-2">
    @foreach($categories as $category)
    @if(in_array($category->id, $selectedCategories))
    <span class="wrap tag select-none mt-2">{{ $category->name }}</span>
    @endif
    @endforeach
</div>

<!-- ARTIKELEN -->
<span class="text-sm italic mt-4">{{ count($articles) }} Artikelen gevonden</span>

@foreach($articles as $article)
<a href="{{ route('articles.show', $article->id) }}">
    <div class="wrap bg-green-200 hover:bg-green-300">
        <div class="flex">
            <h4 class="text-lg font-bold mb-1 mr-5">{{ $article->name }}</h4>
            <div class="flex gap-1">
                @foreach($article->categories->sortBy('name') as $category)
                <span class="wrap tag">{{$category->name}}</span>
                @endforeach
                @if($article->premium)
                <span class="wrap tag premium">premium</span>
                @endif
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

<!-- SCRIPT VOOR FILTER POPUP -->
<script>
    const toggle = document.getElementById('filterToggle');
    const popup = document.getElementById('filterPopup');

    toggle.addEventListener('click', (event) => {
        event.stopPropagation();
        popup.classList.toggle('hidden');
    });

    document.addEventListener('click', (event) => {
        if (!popup.contains(event.target)) {
            popup.classList.add('hidden');
        }
    });
</script>

@endsection