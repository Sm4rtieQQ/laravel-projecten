@extends('layouts.app')

@section('title', 'Login')

@section('content')

<h1 class="h1">Inloggen</h1>
<form>
    @csrf
    <div class="wrap">
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="email">Email</label>
            <input class="bg-white w-5/6">
        </div>
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="password">Wachtwoord</label>
            <input class="bg-white w-5/6">
        </div>
    </div>
    <button class="btn-submit" type="submit">Inloggen</button>
</form>
@endsection