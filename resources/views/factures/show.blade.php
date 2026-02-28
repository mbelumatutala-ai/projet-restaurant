<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture {{ $facture->numero_facture }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<x-navbar active="commandes" />
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Facture {{ $facture->numero_facture }}</h3>
        <a href="{{ route('commandes.show', $facture->commande) }}" class="btn btn-outline-secondary">Retour commande</a>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4"><strong>Client:</strong> {{ $facture->commande->nom_client }}</div>
                <div class="col-md-4"><strong>Emission:</strong> {{ \Carbon\Carbon::parse($facture->date_emission)->format('d/m/Y') }}</div>
                <div class="col-md-4"><strong>Statut paiement:</strong> {{ $facture->statut_paiement }}</div>
                <div class="col-md-4"><strong>Mode paiement:</strong> {{ $facture->mode_paiement ?: 'Non defini' }}</div>
                <div class="col-md-4"><strong>Table:</strong> {{ $facture->commande->numero_table ?: '-' }}</div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Plat</th>
                        <th>Quantite</th>
                        <th>Prix unitaire</th>
                        <th>Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facture->commande->lignesCommandes as $ligne)
                        <tr>
                            <td>{{ $ligne->plat->nom ?? 'Plat supprime' }}</td>
                            <td>{{ $ligne->quantite }}</td>
                            <td>{{ number_format((float) $ligne->prix_unitaire, 2, ',', ' ') }} $</td>
                            <td>{{ number_format((float) $ligne->sous_total, 2, ',', ' ') }} $</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <div class="card border-0 shadow-sm" style="min-width: 320px;">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Montant HT</span>
                    <strong>{{ number_format((float) $facture->montant_total, 2, ',', ' ') }} $</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Taxe</span>
                    <strong>{{ number_format((float) ($facture->taxe ?? 0), 2, ',', ' ') }} $</strong>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Total TTC</span>
                    <strong>{{ number_format((float) ($facture->montant_total + ($facture->taxe ?? 0)), 2, ',', ' ') }} $</strong>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
