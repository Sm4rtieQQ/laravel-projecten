@extends('layouts.app')

@section('title', 'Register')

@section('content')
<h1 class="h1">Nieuwe gebruiker</h1>

@if ($errors->any())
<div>
    @foreach ($erros->all() as $error)
    <p> {{$error}} </p>
    @endforeach
</div>
@endif
<form action="{{ route('user.store') }}" method="post">
    @csrf
    <div class="wrap">
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="name">Naam</label>
            <input class="bg-white w-5/6" id="name" name="name" type="text">
        </div>
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="email">Email</label>
            <input class="bg-white w-5/6" id="email" name="email" type="email">
        </div>
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="password">Wachtwoord</label>
            <input class="bg-white w-5/6" id="password" name="password" type="password">
        </div>
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="password_confirmation">Bevestig wachtwoord</label>
            <input class="bg-white w-5/6" id="password_confirmation" name="password_confirmation" type="password">
        </div>
    </div>
    <button class="btn-submit" type="submit">Registreren</button>
</form>
@endsection