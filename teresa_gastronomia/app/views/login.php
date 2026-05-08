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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1200px;
            display: flex;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: fadeInUp 0.6s ease;
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

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 50px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .login-left p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .login-left .features {
            margin-top: 30px;
        }

        .login-left .feature {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }

        .login-left .feature i {
            font-size: 20px;
            margin-right: 15px;
        }

        .login-right {
            flex: 1;
            padding: 50px;
            background: white;
        }

        .login-right h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .login-right .subtitle {
            color: #666;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .input-group {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .input-group:focus-within {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
        }

        .input-group-text {
            background: white;
            border: none;
            color: #667eea;
        }

        .form-control {
            border: none;
            padding: 12px;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            width: 100%;
            border-radius: 10px;
            transition: transform 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            color: white;
        }

        .credentials {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .credentials h6 {
            color: #667eea;
            margin-bottom: 10px;
        }

        .credentials p {
            margin: 5px 0;
            font-size: 13px;
        }

        .credentials code {
            background: #e9ecef;
            padding: 2px 6px;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .login-left {
                display: none;
            }
            .login-right {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-left">
            <div>
                <i class="fas fa-utensils" style="font-size: 60px; margin-bottom: 20px;"></i>
                <h1>Grupo Tereza</h1>
                <h1 class="display-4">Gastronomia</h1>
                <p>Sistema completo de gestão de filiais e fornecedores para a melhor rede de restaurantes da região Centro-Sul do Ceará.</p>
                <div class="features">
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Gestão de filiais em tempo real</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Controle de fornecedores integrado</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Análise de vendas e consumo</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Alertas automáticos de estoque</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Dashboard interativo com gráficos</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-right">
            <h2>Bem-vindo!</h2>
            <p class="subtitle">Faça login para acessar o sistema de gestão</p>
            
            <?php if(isset($_SESSION['erro'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['mensagem'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <form action="index.php?action=login" method="POST">
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" required placeholder="Digite seu e-mail" value="<?php echo isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Senha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="senha" required placeholder="Digite sua senha">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="lembrar" id="lembrar">
                        <label class="form-check-label" for="lembrar">
                            Lembrar meu e-mail
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Entrar no Sistema
                </button>
            </form>

            <div class="credentials">
                <h6><i class="fas fa-info-circle"></i> Credenciais de Acesso</h6>
                <p><strong>🎯 Matriz (Administrador):</strong></p>
                <p>📧 E-mail: <code>admin@teresa.com</code></p>
                <p>🔑 Senha: <code>admin123</code></p>
                <hr>
                <p><strong>🏪 Filial Crato (Gerente):</strong></p>
                <p>📧 E-mail: <code>crato@teresa.com</code></p>
                <p>🔑 Senha: <code>filial123</code></p>
                <hr>
                <p><strong>🏪 Filial Barbalha (Gerente):</strong></p>
                <p>📧 E-mail: <code>barbalha@teresa.com</code></p>
                <p>🔑 Senha: <code>filial123</code></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>