<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Fornecedores - Matriz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6f9; }
        
        .sidebar {
            background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            z-index: 1000;
        }
        
        .sidebar-header { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-header i { font-size: 50px; color: #667eea; }
        .sidebar-header h4 { color: white; margin-top: 10px; }
        
        .sidebar-menu { padding: 0 15px; }
        .sidebar-menu a {
            display: block;
            padding: 12px 15px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }
        .sidebar-menu a:hover { background: rgba(255,255,255,0.1); color: white; }
        .sidebar-menu a.active { background: linear-gradient(135deg, #667eea, #764ba2); color: white; }
        .sidebar-menu a i { width: 25px; margin-right: 10px; }
        
        .main-content { margin-left: 260px; padding: 20px; }
        
        .top-bar {
            background: white;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card { border: none; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .card-header { background: white; border-bottom: 2px solid #f0f0f0; padding: 20px; font-weight: 600; }
        
        .btn-primary { background: linear-gradient(135deg, #667eea, #764ba2); border: none; }
        .btn-primary:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-utensils"></i>
            <h4>Grupo Tereza</h4>
            <p style="color: rgba(255,255,255,0.7);">Matriz</p>
        </div>
        <div class="sidebar-menu">
            <a href="index.php?action=matriz_dashboard"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="index.php?action=matriz_filiais"><i class="fas fa-store"></i> Filiais</a>
            <a href="index.php?action=matriz_fornecedores" class="active"><i class="fas fa-truck"></i> Fornecedores</a>
            <a href="index.php?action=matriz_vendas"><i class="fas fa-chart-simple"></i> Vendas</a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h2>Gerenciamento de Fornecedores</h2>
                <p>Cadastre e gerencie todos os fornecedores</p>
            </div>
            <div class="user-info">
                <span class="badge" style="background: linear-gradient(135deg, #667eea, #764ba2); padding: 8px 15px; border-radius: 20px; color: white;">
                    <i class="fas fa-user"></i> <?php echo $_SESSION['usuario_nome']; ?>
                </span>
                <a href="index.php?action=logout" style="background: #dc3545; color: white; padding: 8px 15px; border-radius: 8px; text-decoration: none;">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastrarFornecedorModal">
                        <i class="fas fa-plus"></i> Novo Fornecedor
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Fornecedor</th>
                                    <th>CNPJ</th>
                                    <th>Representante</th>
                                    <th>Região</th>
                                    <th>Ramo</th>
                                    <th>Contato</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($fornecedores as $fornecedor): ?>
                                <tr>
                                    <td><strong><?php echo $fornecedor['nome']; ?></strong></td>
                                    <td><?php echo $fornecedor['cnpj']; ?></td>
                                    <td><?php echo $fornecedor['nome_representante']; ?></td>
                                    <td><span class="badge bg-info"><?php echo $fornecedor['regiao_atuacao']; ?></span></td>
                                    <td><?php echo $fornecedor['ramo_alimenticio']; ?></td>
                                    <td>
                                        <i class="fas fa-envelope"></i> <?php echo $fornecedor['email']; ?><br>
                                        <i class="fas fa-phone"></i> <?php echo $fornecedor['telefone']; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" onclick="alert('Visualizar')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="alert('Editar')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cadastrar Fornecedor -->
    <div class="modal fade" id="cadastrarFornecedorModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white;">
                    <h5 class="modal-title"><i class="fas fa-truck"></i> Cadastrar Novo Fornecedor</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="index.php?action=matriz_cadastrar_fornecedor" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nome do Fornecedor *</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CNPJ *</label>
                                <input type="text" class="form-control" name="cnpj" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">E-mail *</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Telefone *</label>
                                <input type="text" class="form-control" name="telefone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nome do Representante *</label>
                                <input type="text" class="form-control" name="representante" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Região de Atuação *</label>
                                <select class="form-select" name="regiao" required>
                                    <option value="">Selecione...</option>
                                    <option value="Centro-Sul">Centro-Sul</option>
                                    <option value="Norte">Norte</option>
                                    <option value="Sul">Sul</option>
                                    <option value="Leste">Leste</option>
                                    <option value="Oeste">Oeste</option>
                                    <option value="Todas">Todas as Regiões</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ramo Alimentício *</label>
                                <select class="form-select" name="ramo" required>
                                    <option value="">Selecione...</option>
                                    <option value="Carnes">Carnes e Derivados</option>
                                    <option value="Laticinios">Laticínios</option>
                                    <option value="Graos">Grãos</option>
                                    <option value="Vegetais">Vegetais</option>
                                    <option value="Bebidas">Bebidas</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Localização *</label>
                                <input type="text" class="form-control" name="localizacao" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar Fornecedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>