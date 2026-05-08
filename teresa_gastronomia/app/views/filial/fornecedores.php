<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores - Filial</title>
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
        
        .supplier-card {
            transition: all 0.3s;
            cursor: pointer;
        }
        .supplier-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        
        .btn-pedido { background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; }
        .btn-pedido:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-utensils"></i>
            <h4>Grupo Tereza</h4>
            <p style="color: rgba(255,255,255,0.7);">Filial</p>
        </div>
        <div class="sidebar-menu">
            <a href="index.php?action=filial_dashboard"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="index.php?action=filial_vendas"><i class="fas fa-cash-register"></i> Registrar Vendas</a>
            <a href="index.php?action=filial_fornecedores" class="active"><i class="fas fa-truck"></i> Fornecedores</a>
            <a href="index.php?action=filial_pedidos"><i class="fas fa-shopping-cart"></i> Pedidos</a>
            <a href="index.php?action=filial_estoque"><i class="fas fa-boxes"></i> Estoque</a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h2>Fornecedores Disponíveis</h2>
                <p>Fornecedores que atendem sua região</p>
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
            <div class="row">
                <?php foreach($fornecedores as $fornecedor): ?>
                <div class="col-md-6 mb-4">
                    <div class="card supplier-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <i class="fas fa-truck" style="font-size: 40px; color: #667eea;"></i>
                                </div>
                                <button class="btn btn-sm btn-pedido" data-bs-toggle="modal" data-bs-target="#pedidoModal<?php echo $fornecedor['id']; ?>">
                                    <i class="fas fa-shopping-cart"></i> Solicitar Pedido
                                </button>
                            </div>
                            <h5 class="card-title"><?php echo $fornecedor['nome']; ?></h5>
                            <p class="card-text">
                                <i class="fas fa-user"></i> Representante: <?php echo $fornecedor['nome_representante']; ?><br>
                                <i class="fas fa-envelope"></i> <?php echo $fornecedor['email']; ?><br>
                                <i class="fas fa-phone"></i> <?php echo $fornecedor['telefone']; ?><br>
                                <i class="fas fa-map-marker-alt"></i> <?php echo $fornecedor['localizacao']; ?><br>
                                <i class="fas fa-tag"></i> Ramo: <?php echo $fornecedor['ramo_alimenticio']; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Modal Pedido -->
                <div class="modal fade" id="pedidoModal<?php echo $fornecedor['id']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white;">
                                <h5 class="modal-title">Solicitar Pedido - <?php echo $fornecedor['nome']; ?></h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="index.php?action=filial_criar_pedido" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="fornecedor_id" value="<?php echo $fornecedor['id']; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Observações</label>
                                        <textarea class="form-control" name="observacao" rows="3" placeholder="Descreva os insumos que precisa..."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Enviar Pedido</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>