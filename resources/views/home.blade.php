<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f8f9fa; }
        .card-img-top { height: 180px; object-fit: cover; background: #e9ecef; }
        .price { color: #198754; font-weight: 700; font-size: 1.1rem; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Le Gourmet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navHome">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navHome">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('menu') }}">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('commandes.index') }}">Commandes</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <span>{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Deconnexion</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Nos plats populaires</h3>
        <a href="{{ route('menu') }}" class="btn btn-primary btn-sm">Voir tout le menu</a>
    </div>

    <div class="row g-4">
        @forelse($plats as $plat)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm">
                    <img
                        src="{{ $plat->thmbdail ?: 'https://via.placeholder.com/640x480?text=Plat' }}"
                        class="card-img-top"
                        alt="{{ $plat->nom }}"
                    >
                    <div class="card-body">
                        <h5 class="card-title">{{ $plat->nom }}</h5>
                        <p class="card-text text-muted">{{ $plat->description ?: 'Aucune description disponible.' }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price">{{ number_format((float) $plat->prix, 2, ',', ' ') }} $</span>
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('commandes.create', ['plat' => $plat->id]) }}">Commander</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info mb-0">Aucun plat disponible pour le moment.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $plats->links() }}
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
