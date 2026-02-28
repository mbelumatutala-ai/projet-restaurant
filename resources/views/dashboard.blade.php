<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<x-navbar active="dashboard" />

<div class="container py-4">
    <h3 class="mb-4">Dashboard administrateur</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold">Ajouter un plat</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('plats.store') }}">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Nom</label>
                            <input class="form-control" type="text" name="nom" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="2"></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Thumbnail URL</label>
                            <input class="form-control" type="url" name="thmbdail">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Prix</label>
                            <input class="form-control" type="number" step="0.01" min="0" name="prix" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categorie</label>
                            <input class="form-control" type="text" name="categorie">
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="est_disponible" id="est_disponible" value="1" checked>
                            <label class="form-check-label" for="est_disponible">Disponible</label>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Ajouter le plat</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Plats</span>
                    <a href="{{ route('menu') }}" class="btn btn-sm btn-outline-secondary">Voir menu client</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Categorie</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plats as $plat)
                                <tr>
                                    <td>{{ $plat->nom }}</td>
                                    <td>{{ number_format((float) $plat->prix, 2, ',', ' ') }} $</td>
                                    <td>{{ $plat->categorie ?: '-' }}</td>
                                    <td class="text-end">
                                        <form method="POST" action="{{ route('plats.destroy', $plat) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-3">Aucun plat.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-body py-2">
                    {{ $plats->links() }}
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Dernieres commandes</span>
                    <a href="{{ route('commandes.index') }}" class="btn btn-sm btn-outline-primary">Gerer commandes</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Statut</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($commandes as $commande)
                                <tr>
                                    <td>{{ $commande->id }}</td>
                                    <td>{{ $commande->nom_client }}</td>
                                    <td>{{ $commande->facture ? 'facturee' : $commande->statut }}</td>
                                    <td>{{ number_format((float) $commande->montant_total, 2, ',', ' ') }} $</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('commandes.show', $commande) }}">Voir</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center py-3">Aucune commande.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-body py-2">
                    {{ $commandes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
