@extends('layouts.app')

@section('title', 'Inloggen')

@section('content')
<div class="w-[500px] justify-self-center">
    <h1 class="h1">Inloggen</h1>

    <form action="{{route('user.auth')}}" method="POST">
        @csrf
        <div class="wrap">
            <div class="p-4 grid grid-cols-[120px_auto] gap-y-4">

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

            </div>
        </div>
        <div class="flex">
            <button class="btn-submit" type="submit">Inloggen</button>
            <a class="btn-neutral" href="{{route('register')}}">Registreren</a>
        </div>
    </form>
</div>
@endsection