@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class=" max-w-[500px] justify-self-center">
    <h1 class="h1">Nieuwe gebruiker</h1>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="wrap">
            <div class="p-4 grid grid-cols-[120px_auto] gap-y-4">

                <label class="font-bold" for="name">Naam</label>
                <div class="grid">
                    <input class="bg-white" id="name" name="name" type="text" value="{{ old('name')}}">
                    @error('name')
                    <span class="text-red-700 text-sm">{{$message}}</span>
                    @enderror
                </div>

                <label class="font-bold" for="email">Email</label>
                <div class="grid">
                    <input class="bg-white" id="email" name="email" value="{{ old('email')}}">
                    @error('email')
                    <span class="text-red-700 text-sm">{{$message}}</span>
                    @enderror
                </div>

                <label class="font-bold" for="password">Wachtwoord</label>
                <div class="grid">
                    <input class="bg-white" id="password" name="password" type="password">
                    @error('password')
                    <span class="text-red-700 text-sm">{{$message}}</span>
                    @enderror
                </div>

                <label class="font-bold" for="password_confirmation">Bevestig wachtwoord</label>
                <div class="grid">
                    <input class="bg-white" id="password_confirmation" name="password_confirmation" type="password">
                    @error('password_confirmation')
                    <span class="text-red-700 text-sm">{{$message}}</span>
                    @enderror
                </div>

            </div>
        </div>
        <button class="btn-submit" type="submit">Registreren</button>
    </form>
</div>
@endsection