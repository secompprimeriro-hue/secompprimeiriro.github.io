<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vendas - Filial</title>
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
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102,126,234,0.4); }
        
        .form-control, .form-select { border-radius: 8px; border: 1px solid #e0e0e0; padding: 10px; }
        .form-control:focus, .form-select:focus { border-color: #667eea; box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.25); }
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
            <a href="index.php?action=filial_vendas" class="active"><i class="fas fa-cash-register"></i> Registrar Vendas</a>
            <a href="index.php?action=filial_fornecedores"><i class="fas fa-truck"></i> Fornecedores</a>
            <a href="index.php?action=filial_pedidos"><i class="fas fa-shopping-cart"></i> Pedidos</a>
            <a href="index.php?action=filial_estoque"><i class="fas fa-boxes"></i> Estoque</a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h2>Registrar Vendas</h2>
                <p>Registre as vendas da sua filial</p>
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
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-plus-circle"></i> Nova Venda
                        </div>
                        <div class="card-body">
                            <?php if(isset($_SESSION['mensagem'])): ?>
                                <div class="alert alert-success">
                                    <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
                                </div>
                            <?php endif; ?>
                            
                            <form action="index.php?action=filial_registrar_venda" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Produto</label>
                                    <select class="form-select" name="produto_id" required>
                                        <option value="">Selecione um produto</option>
                                        <?php foreach($produtos as $produto): ?>
                                        <option value="<?php echo $produto['id']; ?>">
                                            <?php echo $produto['nome']; ?> - R$ <?php echo number_format($produto['preco_venda'], 2); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Quantidade</label>
                                    <input type="number" class="form-control" name="quantidade" required min="1">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-check"></i> Registrar Venda
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-history"></i> Últimas Vendas
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Valor Unitário</th>
                                            <th>Total</th>
                                            <th>Data/Hora</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($vendas as $venda): ?>
                                        <tr>
                                            <td><?php echo $venda['produto']; ?></td>
                                            <td><?php echo $venda['quantidade']; ?></td>
                                            <td>R$ <?php echo number_format($venda['valor_unitario'], 2); ?></td>
                                            <td>R$ <?php echo number_format($venda['valor_total'], 2); ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($venda['data_venda'])); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>