<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Plat</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 0;
        }

        /* Custom Navbar */
        .dashboard-navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand-custom {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand-custom:hover {
            color: rgba(255, 255, 255, 0.8);
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-middle {
            display: flex;
            gap: 30px;
            align-items: center;
            flex: 1;
            justify-content: center;
        }

        .navbar-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .navbar-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .user-menu {
            position: relative;
        }

        .user-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .user-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .dropdown-menu-custom {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-top: 10px;
            min-width: 200px;
            z-index: 1001;
        }

        .dropdown-menu-custom.active {
            display: block;
        }

        .dropdown-item-custom {
            padding: 12px 20px;
            color: #2d3748;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .dropdown-item-custom:hover {
            background: #f7fafc;
        }

        .dropdown-item-custom.danger {
            color: var(--danger-color);
        }

        .dropdown-item-custom.danger:hover {
            background: #fed7d7;
        }

        .dropdown-item-custom:first-child {
            border-radius: 8px 8px 0 0;
        }

        .dropdown-item-custom:last-child {
            border-radius: 0 0 8px 8px;
        }

        .container-fluid-nav {
            padding: 0 20px;
        }

        .form-container {
            max-width: 700px;
            margin: 40px auto;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            border: none;
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-body {
            padding: 35px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control, .form-control:focus, textarea.form-control {
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
            font-family: inherit;
        }

        .file-input-wrapper {
            position: relative;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 2px dashed var(--primary-color);
            border-radius: 8px;
            padding: 30px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-color: var(--secondary-color);
        }

        .file-input-label.has-file {
            background: linear-gradient(135deg, rgba(72, 187, 120, 0.05) 0%, rgba(56, 161, 105, 0.05) 100%);
            border-color: var(--success-color);
        }

        #thmbdail {
            display: none;
        }

        .file-icon {
            font-size: 2rem;
            color: var(--primary-color);
        }

        .file-text {
            text-align: center;
            flex: 1;
        }

        .file-text-main {
            color: var(--primary-color);
            font-weight: 600;
            display: block;
        }

        .file-text-sub {
            color: #718096;
            font-size: 0.9rem;
            display: block;
        }

        .file-preview {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .file-preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .file-preview-name {
            margin-top: 10px;
            color: #4a5568;
            font-size: 0.9rem;
            word-break: break-all;
        }

        .help-text {
            color: #718096;
            font-size: 0.85rem;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-check {
            display: flex;
            align-items: center;
            padding: 15px;
            background: #f7fafc;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            cursor: pointer;
            border: 2px solid var(--primary-color);
            margin-right: 12px;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-label {
            cursor: pointer;
            margin: 0;
            font-weight: 500;
            color: #2d3748;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 35px;
        }

        .btn-submit {
            flex: 1;
            background: linear-gradient(135deg, var(--success-color) 0%, #38a169 100%);
            border: none;
            color: white;
            padding: 14px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(72, 187, 120, 0.4);
            color: white;
        }

        .btn-cancel {
            background: #e2e8f0;
            border: none;
            color: #2d3748;
            padding: 14px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cancel:hover {
            background: #cbd5e0;
            color: #2d3748;
        }

        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .alert-danger-custom {
            background: linear-gradient(135deg, #fed7d7 0%, #fc8181 100%);
            color: #742a2a;
        }

        .back-link {
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            gap: 12px;
        }

        @media (max-width: 768px) {
            .form-body {
                padding: 25px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            .navbar-middle {
                gap: 10px;
            }

            .navbar-link {
                padding: 6px 10px;
                font-size: 0.9rem;
            }

            .navbar-content {
                flex-direction: column;
                gap: 15px;
            }

            .navbar-middle {
                width: 100%;
                justify-content: flex-start;
            }

            .navbar-right {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
<!-- Custom Dashboard Navbar -->
<nav class="dashboard-navbar">
    <div class="container-fluid-nav">
        <div class="navbar-content">
            <a href="{{ route('dashboard') }}" class="navbar-brand-custom">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>

            <div class="navbar-middle">
                <a href="{{ route('commandes.index') }}" class="navbar-link">
                    <i class="fas fa-receipt"></i> Commandes
                </a>
            </div>

            <div class="navbar-right">
                <div class="user-menu">
                    <button class="user-btn" onclick="toggleUserMenu()">
                        <i class="fas fa-user-circle"></i>
                        {{ auth()->user()->name }}
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu-custom" id="userDropdown">
                        <a href="{{ route('home') }}" class="dropdown-item-custom">
                            <i class="fas fa-home"></i> Retour à l'accueil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                            @csrf
                            <button type="submit" class="dropdown-item-custom danger" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer;">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h1 class="form-title">
                <i class="fas fa-plus"></i> Ajouter un nouveau plat
            </h1>
            <a href="{{ route('dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="form-body">
            @if($errors->any())
                <div class="alert alert-danger alert-custom alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle"></i>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('plats.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Nom -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-heading"></i> Nom du plat
                    </label>
                    <input class="form-control @error('nom') is-invalid @enderror" 
                           type="text" 
                           name="nom" 
                           placeholder="Ex: Couscous Royal" 
                           value="{{ old('nom') }}"
                           required>
                    @error('nom')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-align-left"></i> Description
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              name="description" 
                              placeholder="Décrivez votre plat (ingrédients, saveurs, etc.)">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-image"></i> Image du plat
                    </label>
                    <div class="file-input-wrapper">
                        <label for="thmbdail" class="file-input-label" id="fileLabel">
                            <div class="file-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="file-text">
                                <span class="file-text-main">Cliquez pour télécharger</span>
                                <span class="file-text-sub">ou glissez-déposez votre image</span>
                            </div>
                        </label>
                        <input class="form-control @error('thmbdail') is-invalid @enderror" 
                               type="file" 
                               id="thmbdail"
                               name="thmbdail" 
                               accept="image/*">
                        <div class="file-preview" id="filePreview">
                            <img id="previewImage" src="" alt="Preview">
                            <div class="file-preview-name" id="fileName"></div>
                            <small class="help-text">
                                <i class="fas fa-check-circle" style="color: var(--success-color);"></i>
                                Image prête à être uploadée
                            </small>
                        </div>
                        @error('thmbdail')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                        <div class="help-text">
                            <i class="fas fa-info-circle"></i>
                            Formats acceptés: JPG, PNG. Taille max: 2MB
                        </div>
                    </div>
                </div>

                <!-- Prix et Catégorie -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-dollar-sign"></i> Prix
                        </label>
                        <input class="form-control @error('prix') is-invalid @enderror" 
                               type="number" 
                               step="0.01" 
                               min="0" 
                               name="prix" 
                               placeholder="0.00"
                               value="{{ old('prix') }}"
                               required>
                        @error('prix')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-tag"></i> Catégorie
                        </label>
                        <input class="form-control @error('categorie') is-invalid @enderror" 
                               type="text" 
                               name="categorie" 
                               placeholder="Ex: Entrée, Plat principal..."
                               value="{{ old('categorie') }}">
                        @error('categorie')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Disponibilité -->
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="est_disponible" 
                               id="est_disponible" 
                               value="1"
                               {{ old('est_disponible') ? 'checked' : 'checked' }}>
                        <label class="form-check-label" for="est_disponible">
                            <i class="fas fa-check"></i> Ce plat est disponible
                        </label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button class="btn-submit" type="submit">
                        <i class="fas fa-plus"></i> Ajouter le plat
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn-cancel">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const fileInput = document.getElementById('thmbdail');
    const fileLabel = document.getElementById('fileLabel');
    const filePreview = document.getElementById('filePreview');
    const previewImage = document.getElementById('previewImage');
    const fileName = document.getElementById('fileName');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewImage.src = event.target.result;
                fileName.textContent = file.name;
                filePreview.style.display = 'block';
                fileLabel.classList.add('has-file');
            };
            reader.readAsDataURL(file);
        }
    });

    // Drag and drop
    fileLabel.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        fileLabel.style.opacity = '0.7';
    });

    fileLabel.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        fileLabel.style.opacity = '1';
    });

    fileLabel.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        fileLabel.style.opacity = '1';
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            const event = new Event('change', { bubbles: true });
            fileInput.dispatchEvent(event);
        }
    });

    function toggleUserMenu() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('active');
    }

    // Fermer le menu en cliquant ailleurs
    document.addEventListener('click', function(event) {
        const userMenu = document.querySelector('.user-menu');
        if (!userMenu.contains(event.target)) {
            document.getElementById('userDropdown').classList.remove('active');
        }
    });
</script>
</body>
</html>
