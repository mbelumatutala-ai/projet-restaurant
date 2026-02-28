<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .thumb { width: 72px; height: 72px; object-fit: cover; border-radius: 10px; }
    </style>
</head>
<body class="bg-light">
<x-navbar active="panier" />
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Panier</h3>
        <a href="{{ route('menu') }}" class="btn btn-outline-secondary">Continuer les achats</a>
    </div>

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

    @if($items->isEmpty())
        <div class="alert alert-info">Votre panier est vide.</div>
    @else
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-semibold">Articles</div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Plat</th>
                                    <th>Prix</th>
                                    <th style="width: 180px;">Quantite</th>
                                    <th>Sous-total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img class="thumb" src="{{ $item['plat']->thmbdail ?: 'https://via.placeholder.com/640x480?text=Plat' }}" alt="{{ $item['plat']->nom }}">
                                                <div>
                                                    <div class="fw-semibold">{{ $item['plat']->nom }}</div>
                                                    <div class="small text-muted">{{ $item['plat']->categorie ?: 'sans categorie' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format((float) $item['prix_unitaire'], 2, ',', ' ') }} $</td>
                                        <td>
                                            <form method="POST" action="{{ route('panier.update', $item['plat']) }}" class="d-flex gap-2">
                                                @csrf
                                                <input type="number" min="0" name="quantite" value="{{ $item['quantite'] }}" class="form-control form-control-sm">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">OK</button>
                                            </form>
                                        </td>
                                        <td>{{ number_format((float) $item['sous_total'], 2, ',', ' ') }} $</td>
                                        <td>
                                            <form method="POST" action="{{ route('panier.remove', $item['plat']) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Retirer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white fw-semibold">Informations client</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('commandes.store') }}" id="checkout-form">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nom client</label>
                                <input type="text" name="nom_client" value="{{ old('nom_client', auth()->user()->name) }}" class="form-control" required>
                            </div>
                            <div class="mb-0">
                                <label class="form-label">Numero de table</label>
                                <input type="text" name="numero_table" value="{{ old('numero_table') }}" class="form-control">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-semibold">Total</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Montant HT</span>
                            <strong>{{ number_format((float) $montantTotal, 2, ',', ' ') }} $</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Taxe (18%)</span>
                            <strong>{{ number_format((float) $taxe, 2, ',', ' ') }} $</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total TTC</span>
                            <strong>{{ number_format((float) $totalTtc, 2, ',', ' ') }} $</strong>
                        </div>
                        <button type="submit" form="checkout-form" class="btn btn-primary w-100 mb-2">Passer la commande</button>
                        <form method="POST" action="{{ route('panier.clear') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100">Vider le panier</button>
                        </form>
                    </div>
                </div>
                <div class="small text-muted mt-2">
                    La facture sera generee uniquement apres validation par un administrateur.
                </div>
            </div>
        </div>
    @endif
</div>
</body>
</html>
