@props(['active' => ''])
@php($cartCount = collect(session('cart', []))->sum())

<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Le Gourmet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ $active === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active === 'menu' ? 'active' : '' }}" href="{{ route('menu') }}">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active === 'commandes' ? 'active' : '' }}" href="{{ route('commandes.index') }}">Commandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active === 'panier' ? 'active' : '' }}" href="{{ route('commandes.create') }}">
                        Panier
                        @if($cartCount > 0)
                            <span class="badge text-bg-primary ms-1">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
            </ul>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ auth()->user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @if(auth()->user()->role === 'admin')
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @endif
                    <li>
                        <a class="dropdown-item" href="{{ route('commandes.index') }}">Mes commandes</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Deconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
