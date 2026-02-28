<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription - Restaurant</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            width: 100%;
            max-width: 500px;
        }
        
        .card-header {
            background: transparent;
            border-bottom: 2px solid #f0f0f0;
            padding: 30px 30px 20px 30px;
            text-align: center;
        }
        
        .card-header h2 {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .card-header p {
            color: #666;
            font-size: 14px;
            margin-bottom: 0;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
            transition: color 0.3s ease;
            z-index: 10;
        }
        
        .form-control {
            height: 55px;
            padding: 10px 15px 10px 50px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            background: #ffffff;
        }
        
        .form-control:focus + i {
            color: #667eea;
        }
        
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 20px 0;
            position: relative;
            overflow: hidden;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }
        
        .login-link {
            text-align: center;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }
        
        .login-link p {
            color: #666;
            font-size: 15px;
            margin-bottom: 0;
        }
        
        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .login-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            font-size: 14px;
        }
        
        .alert-danger {
            background: #fee;
            color: #c33;
        }
        
        .invalid-feedback {
            display: block;
            margin-top: 5px;
            font-size: 13px;
            color: #dc3545;
        }
        
        .password-requirements {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-top: 10px;
            font-size: 13px;
            color: #666;
        }
        
        .password-requirements i {
            position: relative;
            left: 0;
            transform: none;
            margin-right: 8px;
        }
        
        .password-requirements ul {
            list-style: none;
            padding-left: 0;
            margin-top: 10px;
            margin-bottom: 0;
        }
        
        .password-requirements li {
            margin-bottom: 5px;
        }
        
        .password-requirements li i {
            font-size: 14px;
        }
        
        .text-success {
            color: #28a745 !important;
        }
        
        .text-danger {
            color: #dc3545 !important;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h2><i class="bi bi-person-plus me-2"></i>Inscription</h2>
            <p>Créez votre compte pour accéder à l'espace restaurant</p>
        </div>
        
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <i class="bi bi-person"></i>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           placeholder="Nom complet"
                           value="{{ old('name') }}"
                           required 
                           autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <i class="bi bi-envelope"></i>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           placeholder="Adresse email"
                           value="{{ old('email') }}"
                           required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <i class="bi bi-lock"></i>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           placeholder="Mot de passe"
                           required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" 
                           class="form-control" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           placeholder="Confirmer le mot de passe"
                           required>
                </div>
                
                <div class="password-requirements">
                    <i class="bi bi-shield-check"></i>
                    <strong>Le mot de passe doit contenir :</strong>
                    <ul>
                        <li id="length-check" class="text-danger">
                            <i class="bi bi-x-circle"></i> Au moins 8 caractères
                        </li>
                        <li id="uppercase-check" class="text-danger">
                            <i class="bi bi-x-circle"></i> Au moins une lettre majuscule
                        </li>
                        <li id="number-check" class="text-danger">
                            <i class="bi bi-x-circle"></i> Au moins un chiffre
                        </li>
                    </ul>
                </div>
                
                <button type="submit" class="btn-register">
                    <i class="bi bi-person-plus me-2"></i>S'inscrire
                </button>
                
                <div class="login-link">
                    <p>
                        Vous avez déjà un compte ? 
                        <a href="{{ route('login.page') }}">
                            Se connecter <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Password validation script -->
    <script>
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            
            // Vérification de la longu$
            const lengthCheck = document.getElementById('length-check');
            if (password.length >= 8) {
                lengthCheck.className = 'text-success';
                lengthCheck.innerHTML = '<i class="bi bi-check-circle"></i> Au moins 8 caractères';
            } else {
                lengthCheck.className = 'text-danger';
                lengthCheck.innerHTML = '<i class="bi bi-x-circle"></i> Au moins 8 caractères';
            }
            
            // Vérification de la majuscule
            const uppercaseCheck = document.getElementById('uppercase-check');
            if (/[A-Z]/.test(password)) {
                uppercaseCheck.className = 'text-success';
                uppercaseCheck.innerHTML = '<i class="bi bi-check-circle"></i> Au moins une lettre majuscule';
            } else {
                uppercaseCheck.className = 'text-danger';
                uppercaseCheck.innerHTML = '<i class="bi bi-x-circle"></i> Au moins une lettre majuscule';
            }
            
            // Vérification du chiffre
            const numberCheck = document.getElementById('number-check');
            if (/[0-9]/.test(password)) {
                numberCheck.className = 'text-success';
                numberCheck.innerHTML = '<i class="bi bi-check-circle"></i> Au moins un chiffre';
            } else {
                numberCheck.className = 'text-danger';
                numberCheck.innerHTML = '<i class="bi bi-x-circle"></i> Au moins un chiffre';
            }
        });
    </script>
</body>
</html>
