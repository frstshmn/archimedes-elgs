<nav class="navbar navbar-light bg-light navbar-expand-lg shadow-lg">
    <a href="{{ url('/') }}" class="navbar-brand m-0 pt-2 pb-2">
        <img class="logoscreen" src="{{ asset('images/archimedes_logo_text_horizontal.svg') }}" width="70%" />
    </a>
    <button class="navbar-toggler border-0" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        @if (Route::has('login'))
            <ul class="navbar-nav ml-auto">
                 @if (Auth::check())
                    <li class="navbar-item">
                        <a class="nav-link" href="{{ url('/') }}">Головна</a>
                    </li>
                    <li class="navbar-item">
                        <a class="nav-link" href="{{ url('/cabinet') }}">Кабінет</a>
                    </li>
                @else
                    <li class="navbar-item">
                        <a class="nav-link" href="{{ url('/login') }}">Увійти</a>
                    </li>
                    <li class="navbar-item">
                        <a class="nav-link" href="{{ url('/register') }}">Зареєструватись</a>
                    </li>
                @endif
            </ul>
        @endif
    </div>
</nav>