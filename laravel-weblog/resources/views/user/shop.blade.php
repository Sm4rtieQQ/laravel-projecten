@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="w-[500px] justify-self-center">
    <h1 class="h1">Abonnementen</h1>

    <form action="{{route('user.type')}}" method="POST">
        @csrf
        @method('PUT')
        <div class="wrap grid grid-cols-[auto_auto_50px] gap-y-6 items-center">
            <span>Helemaal gratis!</span>
            <label class="wrap tag ml-auto text-md w-fit p-3 bg-gray-200 select-none" for="free">Gratis account</label>
            <input class="h-6" type="radio" name="account_type" id="free" value="free">
            <span>Probeer nu gratis!</span>
            <label class="wrap tag ml-auto text-md w-fit p-3 premium select-none" for="premium">Premium account</label>
            <input class="h-6" type="radio" name="account_type" id="premium" value="premium">
        </div>
        <div class="flex">
            <button class="btn-submit" type="submit">Afrekenen</button>
            <a class="btn-neutral" href="{{route('dashboard')}}">Terug</a>
        </div>
    </form>
</div>
@endsection