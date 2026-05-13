@extends('layouts.app')

@section('title', 'Login')

@section('content')

<h1 class="h1">Inloggen</h1>
<form action="{{route('user.auth')}}" method="POST">
    @csrf
    <div class="wrap">
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="email">Email</label>
            <input class="bg-white w-5/6" id="email" name="email">
        </div>
        <div class="px-4 flex justify-between">
            <label class="font-bold" for="password">Wachtwoord</label>
            <input class="bg-white w-5/6" id="password" name="password" type="password">
        </div>
        @if ($errors->any())
        <div class="p-4 text-red-400 text-sm">
            @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
        </div>
        @endif
    </div>

    <button class="btn-submit" type="submit">Inloggen</button>
    <a class="btn-neutral" href="{{route('register')}}">Registreren</a>
</form>
@endsection