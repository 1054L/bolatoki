<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('head.head')
        <title>Bolatoki | @yield('subtitle')</title>
    </head>
    <body>
        <div id="app" class="d-felx flex-column h-screen justify-content-between bg-light">
            <header>
                @include('partials.navbar')
                @include('partials.session-status')
            </header>
            <div class="navbarmargin"></div>
            <main class="py-4">
                @yield('content')
            </main>
            <footer class="bg-white text-center text-black-50 py-3 shadow">
                {{ config('app.name') }} | Copyright {{ date('Y') }}
            </footer>
        </div>
    </body>
</html>