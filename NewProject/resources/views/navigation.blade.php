<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="/weather-logo.png" alt="Logo" title="Home" height="50"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('weather') }}">Weather</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>
            </ul>
        </div>


        <ul class="navbar-nav">
            @guest
                <li class="nav-item ">
                    <a class="dropdown-item nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item ">
                    <a class="dropdown-item nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endguest

            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }} - {{ Auth::user()->role }}
                    </a>
                    <ul class="dropdown-menu p-2" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
            {{-- if user is logged in and admin --}}
            @if (Auth::user()->role == 'admin')

                <li><a class="dropdown-item" href="{{ route('admin.allWeather') }}">All Weather</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.addWeather') }}">Add Weather</a></li>
            @endif
            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            @endauth
        </ul>
    </div>
</nav>



<style>
    .navbar-dark .navbar-nav .nav-link {
        color: white;
    }

    .dropdown {
        padding-right: 75px;
    }
</style>
