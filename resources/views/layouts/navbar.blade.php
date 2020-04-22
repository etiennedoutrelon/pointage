<!--Navbar-->
<nav class="navbar navbar-expand-lg cloudy-knoxville-gradient font-weight-bold mb-5" style="font-size: large">

    <!-- Navbar brand -->
    <a class="mr-3" href="{{route('/')}}">
        <img src="{{asset("storage/img/Logo.jpg")}}" height="60" alt="mdb logo" style="border-radius: 5px;">
    </a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify dark-grey-text"></i>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">
        @guest

        @else
            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link dark-grey-text" href="{{route('/')}}">Accueil
                    </a>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dark-grey-text" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Menu</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        @if(Auth::user()->isAdmin())
                            <a class="dropdown-item" href="{{route('indexAdmin')}}" style="font-size: large">Les pointages</a>
                            <a class="dropdown-item" href="{{route('chantiers.index')}}" style="font-size: large">Les chantiers</a>
                            <a class="dropdown-item" href="{{route('employes.index')}}" style="font-size: large">Les employés</a>
                        @else
                            <a class="dropdown-item" href="{{route('pointages.index')}}" style="font-size: large">Mes pointages</a>
                            <a class="dropdown-item" href="{{route('pointages.create')}}" style="font-size: large">Nouveau pointage</a>
                        @endif
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link dark-grey-text" href="#">À propos</a>
                </li>
            </ul>
            <!-- Links -->
        @endguest

        <!-- Collapsible content -->
        <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link dark-grey-text" href="{{ route('login') }}">Connexion</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link dark-grey-text" href="{{ route('register') }}">Inscription</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dark-grey-text" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        @if(Auth::user()->avatar != null)
                            <img src="{{url(Auth::user()->avatar)}}" class="img-fluid roundedImage" alt="Responsive image" style="max-height: 40px;">
                        @else
                            @if(Auth::user()->isAdmin())
                                <i class="fas fa-user-tie"></i>
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        @endif
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('compte') }}" style="font-size: large">Mon compte</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" style="font-size: large"> {{ __('Déconnexion') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
