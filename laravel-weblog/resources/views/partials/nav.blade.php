<nav class="p-4 bg-green-300 text-gray-600 font-bold flex space-x-5">
    <a href="{{ route('articles.index') }}" class="navlink">Overzicht</a>
    <a href="{{ route('articles.create') }}" class="navlink">Nieuw artikel</a>
    @auth
    <a href="{{ route('user.dashboard') }}" class="navlink">Dashboard</a>
    @endauth
    @guest
    <a href="{{ route('user.login') }}" class="navlink ml-auto">Inloggen</a>
    @else
    <form action="{{ route('user.logout')}}" method="post" class="ml-auto">
        @csrf
        <button type="submit" class="navlink">Uitloggen</button>
    </form>
    @endguest
</nav>