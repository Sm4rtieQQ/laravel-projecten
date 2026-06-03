<nav class="p-4 bg-green-300 text-gray-600 font-bold flex space-x-5 sticky top-0 shadow-md z-50">
    <a href="{{ route('articles.index') }}" class="navlink">Overzicht</a>
    @auth
    <a href="{{ route('articles.create') }}" class="navlink">Nieuw artikel</a>
    <a href="{{ route('dashboard') }}" class="navlink">Dashboard</a>
    @endauth
    @guest
    <a href="{{ route('login') }}" class="navlink ml-auto">Inloggen</a>
    @else
    <form action="{{ route('logout')}}" method="POST" class="ml-auto">
        @csrf
        <button type="submit" class="navlink">Uitloggen</button>
    </form>
    @endguest
</nav>