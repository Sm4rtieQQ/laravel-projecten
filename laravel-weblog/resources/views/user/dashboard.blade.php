@extends('layouts.app')

@section('title', 'Login')

@section('content')
<h1 class="h1">Welkom, {{ auth()->user()->name }}</h1>

<form action="{{ route('user.logout') }}" method="POST">
    @csrf
    <button class="btn-cancel" type="submit">Uitloggen</button>
</form>

@endsection