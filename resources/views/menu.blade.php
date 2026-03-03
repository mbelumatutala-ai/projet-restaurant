<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .card-img-top { height: 180px; object-fit: cover; background: #e9ecef; }
        .price { color: #198754; font-weight: 700; font-size: 1.1rem; }
    </style>
</head>
<body>
<x-navbar active="menu" />

<main class="container my-5">
    <h3 class="mb-4">Menu complet</h3>

    @if(session('error'))
        <div class="alert alert-warning">{{ session('error') }}</div>
    @endif

    <form method="GET" action="{{ route('menu') }}" class="row g-2 mb-4">
        <div class="col-md-6">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                class="form-control"
                placeholder="Rechercher un plat, description ou categorie..."
            >
        </div>
        <div class="col-md-4">
            <select name="categorie" class="form-select">
                <option value="">Toutes les categories</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie }}" @selected(request('categorie') === $categorie)>{{ $categorie }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-primary" type="submit">Filtrer</button>
        </div>
    </form>

    <div class="row g-4">
        @forelse($plats as $plat)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm">
                    <img
                        src="{{ $plat->thmbdail ? asset('storage/' . ltrim($plat->thmbdail, '/')) : 'https://via.placeholder.com/640x480?text=Plat' }}"
                        class="card-img-top"
                        alt="{{ $plat->nom }}"
                    >
                    <div class="card-body">
                        <h5 class="card-title">{{ $plat->nom }}</h5>
                        <p class="card-text text-muted">{{ $plat->description ?: 'Aucune description disponible.' }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price">{{ number_format((float) $plat->prix, 2, ',', ' ') }} $</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge text-bg-light">{{ $plat->categorie ?: 'sans categorie' }}</span>
                                <form method="POST" action="{{ route('panier.add', $plat) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Commander</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info mb-0">Aucun plat ne correspond a votre recherche.</div>
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
