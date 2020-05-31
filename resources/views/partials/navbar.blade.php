<nav class="navbar bg-white shadow-sm">
    <div class="container">
        <a href="{{ route('home') }}" class="logo">{{ config('app.name')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarSupportedContent">
            <ul class="nav navbar-expand-sm navbar-light nav-pills">
                <li class="nav-item">
                    <a href="{{ route('leagues.index') }}" class="nav-link {{ setActive('leagues.*') }}">
                        @lang('Leagues')
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('players.index') }}" class="nav-link {{ setActive('players.*') }}">
                        @lang('Players')
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('courts.index') }}" class="nav-link {{ setActive('courts.*') }}">
                        @lang('Courts')
                    </a>
                </li>
                <ul class="nav navbar-expand-sm navbar-light nav-pills float-right">
                    @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link login {{ setActive('login') }}">@lang('Login')</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link login {{ setActive('register') }}">@lang('Register')</a></li>
                    @endguest
                    @auth
                        <li class="nav-item"><a href="#" class="nav-link" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">@lang('Logout')</a></li>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                            @csrf
                        </form>
                    @endauth
                </ul>
            </ul>
        </div>
    </div>
</nav>