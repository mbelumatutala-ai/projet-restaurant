<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture {{ $facture->numero_facture }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --success-color: #48bb78;
            --danger-color: #f56565;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .invoice-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .invoice-number {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .invoice-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 25px;
        }

        .invoice-section-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 20px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .invoice-info {
            padding: 30px;
        }

        .info-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }

        .info-label {
            color: #718096;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .info-value {
            color: #2d3748;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .table-invoice {
            background: white;
            border-collapse: collapse;
        }

        .table-invoice thead {
            background: #f8f9fa;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-invoice th {
            padding: 15px 20px;
            text-align: left;
            color: #4a5568;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-invoice td {
            padding: 15px 20px;
            border-bottom: 1px solid #e2e8f0;
            color: #2d3748;
        }

        .table-invoice tbody tr:hover {
            background: #f7fafc;
        }

        .table-invoice tbody tr:last-child td {
            border-bottom: none;
        }

        .plat-name {
            font-weight: 600;
            color: var(--primary-color);
        }

        .price-cell {
            text-align: right;
            font-weight: 600;
        }

        .summary-container {
            display: flex;
            justify-content: flex-end;
            padding: 30px;
        }

        .summary-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 12px;
            padding: 25px 30px;
            min-width: 350px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .summary-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
            font-size: 1.3rem;
            font-weight: 700;
            padding-top: 12px;
            border-top: 2px solid rgba(255, 255, 255, 0.3);
        }

        .summary-label {
            font-weight: 500;
            opacity: 0.9;
        }

        .summary-value {
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-paid {
            background: #c6f6d5;
            color: #22543d;
        }

        .status-pending {
            background: #feebc8;
            color: #7c2d12;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            padding: 30px;
            justify-content: flex-end;
        }

        .btn-print {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .btn-download {
            background: var(--success-color);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(72, 187, 120, 0.3);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            background: #f7fafc;
            border-radius: 8px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .invoice-header {
                display: none;
            }

            .action-buttons {
                display: none;
            }

            .invoice-card {
                box-shadow: none;
                margin-bottom: 0;
            }
        }

        @media (max-width: 768px) {
            .invoice-title {
                font-size: 1.8rem;
            }

            .info-row {
                grid-template-columns: 1fr;
            }

            .summary-card {
                min-width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-print, .btn-download {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
<x-navbar active="commandes" />

<div class="invoice-container">
    <!-- Header -->
    <div class="invoice-header">
        <div>
            <div class="invoice-title">
                <i class="fas fa-file-invoice"></i> Facture
            </div>
            <div class="invoice-number">N° {{ $facture->numero_facture }}</div>
        </div>
        <a href="{{ route('commandes.show', $facture->commande) }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <!-- Informations Facture -->
    <div class="invoice-card">
        <div class="invoice-section-header">
            <i class="fas fa-info-circle"></i> Informations de la facture
        </div>
        <div class="invoice-info">
            <div class="info-row">
                <div class="info-item">
                    <div class="info-label"><i class="fas fa-user"></i> Client</div>
                    <div class="info-value">{{ $facture->commande->nom_client }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="fas fa-calendar"></i> Date d'émission</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($facture->date_emission)->format('d/m/Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="fas fa-credit-card"></i> Statut paiement</div>
                    <div class="info-value">
                        @if($facture->statut_paiement === 'payée')
                            <span class="status-badge status-paid">✓ Payée</span>
                        @else
                            <span class="status-badge status-pending">⏱ En attente</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-item">
                    <div class="info-label"><i class="fas fa-wallet"></i> Mode paiement</div>
                    <div class="info-value">{{ $facture->mode_paiement ?: 'Non défini' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="fas fa-chair"></i> Table</div>
                    <div class="info-value">{{ $facture->commande->numero_table ?: '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Détails Commande -->
    <div class="invoice-card">
        <div class="invoice-section-header">
            <i class="fas fa-shopping-bag"></i> Détails de la commande
        </div>
        <div style="overflow-x: auto;">
            <table class="table-invoice" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 50%;">Plat</th>
                        <th style="width: 15%; text-align: center;">Quantité</th>
                        <th style="width: 20%; text-align: right;">Prix unitaire</th>
                        <th style="width: 15%; text-align: right;">Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($facture->commande->lignesCommandes as $ligne)
                        <tr>
                            <td class="plat-name">{{ $ligne->plat->nom ?? '❌ Plat supprimé' }}</td>
                            <td style="text-align: center;">
                                <span style="background: #f0f0f0; padding: 4px 8px; border-radius: 4px;">
                                    {{ $ligne->quantite }}
                                </span>
                            </td>
                            <td class="price-cell">{{ number_format((float) $ligne->prix_unitaire, 2, ',', ' ') }} $</td>
                            <td class="price-cell">{{ number_format((float) $ligne->sous_total, 2, ',', ' ') }} $</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="fas fa-inbox" style="font-size: 2rem; color: #a0aec0; margin-bottom: 10px;"></i>
                                    <p>Aucun article dans cette commande</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Résumé Montants -->
    <div style="background: white; padding: 30px; display: flex; justify-content: flex-end;">
        <div class="summary-card">
            <div class="summary-row">
                <span class="summary-label">Montant HT</span>
                <span class="summary-value">{{ number_format((float) $facture->montant_total, 2, ',', ' ') }} $</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Taxe (TVA)</span>
                <span class="summary-value">{{ number_format((float) ($facture->taxe ?? 0), 2, ',', ' ') }} $</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Total TTC</span>
                <span class="summary-value">{{ number_format((float) ($facture->montant_total + ($facture->taxe ?? 0)), 2, ',', ' ') }} $</span>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <button class="btn-print" onclick="window.print()">
            <i class="fas fa-print"></i> Imprimer
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
