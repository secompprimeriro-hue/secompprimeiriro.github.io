<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Grupo Tereza Gastronomia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo i {
            font-size: 60px;
            color: #2d6a4f;
        }

        .login-logo h2 {
            color: #1b4332;
            margin-top: 10px;
            font-weight: 600;
        }

        .login-logo p {
            color: #666;
            font-size: 13px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 13px;
        }

        .input-group {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            background: #f8f9fa;
        }

        .input-group:focus-within {
            border-color: #2d6a4f;
            box-shadow: 0 0 0 3px rgba(45,106,79,0.1);
        }

        .input-group-text {
            background: #f8f9fa;
            border: none;
            color: #2d6a4f;
        }

        .form-control {
            border: none;
            padding: 12px;
            background: #f8f9fa;
        }

        .form-control:focus {
            box-shadow: none;
            background: #f8f9fa;
        }

        .btn-login {
            background: linear-gradient(135deg, #2d6a4f, #1b4332);
            border: none;
            padding: 12px;
            font-size: 15px;
            font-weight: 600;
            color: white;
            width: 100%;
            border-radius: 10px;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(45,106,79,0.4);
        }

        .alert {
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border-left: 3px solid #e63946;
        }

        .footer-note {
            margin-top: 25px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        .footer-note i {
            color: #2d6a4f;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <i class="fas fa-utensils"></i>
                <h2>Grupo Tereza</h2>
                <p>Sistema de Gestão de Filiais e Fornecedores</p>
            </div>

            <?php if(isset($_SESSION['erro'])): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?>
                </div>
            <?php endif; ?>

            <form action="index.php?action=login" method="POST">
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" required placeholder="seu@email.com">
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Senha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="senha" required placeholder="••••••••">
                        <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                            <i class="fas fa-eye-slash" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Entrar no Sistema
                </button>
            </form>

            <div class="footer-note">
                <i class="fas fa-shield-alt"></i> Ambiente seguro e criptografado
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.querySelector('input[name="senha"]');
            const toggleIcon = document.getElementById('toggleIcon');
            if(passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>