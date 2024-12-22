<nav class='navbar navbar-expand-lg navbar-primary bg-primary'>
    <div class='container-fluid'>
        <span class="navbar-brand mb-0 h1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-usb-drive"
                viewBox="0 0 16 16">
                <path
                    d="M6 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4H6zM7 1v1h1V1zm2 0v1h1V1zM6 5a1 1 0 0 0-1 1v8.5A1.5 1.5 0 0 0 6.5 16h4a1.5 1.5 0 0 0 1.5-1.5V6a1 1 0 0 0-1-1zm0 1h5v8.5a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5z" />
            </svg>
            my<strong>Drive</strong></span>

        {{-- Botón para el menú --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
            aria-controls="menu" aria-expanded="false" aria-label="Mostrar y ocultar menú">
            <span class="navbar-toggler-icon"></span>
        </button>


        {{-- Menú de navegación --}}
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class='nav-link @if (request()->routeIs('dashboard')) active @endif'>{{ __('Dashboard') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}"
                        class='nav-link @if (request()->routeIs('profile.edit')) active @endif'>{{ __('Profile') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class='nav-link '>{{ __('Log out') }}</a>
                </li>
            </ul>
            <span class="navbar-text">{{ Auth::user()->name }}</span>
        </div>
    </div>
</nav>
