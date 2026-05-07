<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>WeBlog - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    @include('partials.nav')
    <div class="p-4 px-20">
        @yield('content')
    </div>
</body>

</html>