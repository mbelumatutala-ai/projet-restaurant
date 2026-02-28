<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Gestion des commandes</h3>
        <a href="{{ route('menu') }}" class="btn btn-primary">Nouvelle commande</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Table</th>
                        <th>Statut</th>
                        <th>Total</th>
                        <th>Facture</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>{{ $commande->nom_client }}</td>
                            <td>{{ $commande->numero_table ?: '-' }}</td>
                            <td>{{ $commande->statut }}</td>
                            <td>{{ number_format((float) $commande->montant_total, 2, ',', ' ') }} $</td>
                            <td>
                                @if($commande->facture)
                                    <a href="{{ route('factures.show', $commande->facture) }}">{{ $commande->facture->numero_facture }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('commandes.show', $commande) }}">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Aucune commande pour le moment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $commandes->links() }}
    </div>
</div>
</body>
</html>
