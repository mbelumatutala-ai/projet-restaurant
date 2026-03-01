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
        .hero {
            background: linear-gradient(135deg, #0d6efd 0%, #20c997 100%);
            border-radius: 1.5rem;
            color: #fff;
            overflow: hidden;
            position: relative;
        }
        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.28), transparent 45%);
            pointer-events: none;
        }
        .hero .hero-content {
            position: relative;
            z-index: 1;
        }
        .card-img-top { height: 180px; object-fit: cover; background: #e9ecef; }
        .price { color: #198754; font-weight: 700; font-size: 1.1rem; }
    </style>
</head>
<body>
<x-navbar active="home" />

<main class="container my-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-warning">{{ session('error') }}</div>
    @endif

    <section class="hero p-4 p-md-5 mb-5 shadow-sm">
        <div class="hero-content">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge text-bg-light text-dark mb-3">Le Gourmet</span>
                    <h1 class="display-6 fw-bold mb-3">Savourez nos plats maison, prepares avec des produits frais.</h1>
                    <p class="lead mb-4">
                        Decouvrez les nouveautes du chef, commandez en quelques clics, et suivez vos commandes en temps reel.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('menu') }}" class="btn btn-light btn-lg fw-semibold">Voir le menu</a>
                        <a href="{{ route('commandes.create') }}" class="btn btn-outline-light btn-lg">Mon panier</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white text-dark rounded-4 p-4 shadow-sm">
                        <h5 class="fw-bold mb-3">Pourquoi choisir Le Gourmet ?</h5>
                        <ul class="mb-0 ps-3">
                            <li>Plats faits maison</li>
                            <li>Livraison rapide</li>
                            <li>Suivi des commandes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                            <form method="POST" action="{{ route('panier.add', $plat) }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">Commander</button>
                            </form>
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
