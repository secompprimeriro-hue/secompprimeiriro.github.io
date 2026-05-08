<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque - Filial</title>
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
        
        .status-critical { background: #f8d7da; color: #721c24; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        .status-low { background: #fff3cd; color: #856404; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        .status-normal { background: #d4edda; color: #155724; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        
        .progress { height: 8px; border-radius: 4px; }
        .progress-bar-critical { background: #dc3545; }
        .progress-bar-low { background: #ffc107; }
        .progress-bar-normal { background: #28a745; }
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
            <a href="index.php?action=filial_fornecedores"><i class="fas fa-truck"></i> Fornecedores</a>
            <a href="index.php?action=filial_pedidos"><i class="fas fa-shopping-cart"></i> Pedidos</a>
            <a href="index.php?action=filial_estoque" class="active"><i class="fas fa-boxes"></i> Estoque</a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h2>Controle de Estoque</h2>
                <p>Gerencie o estoque da sua filial</p>
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
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-boxes"></i> Níveis de Estoque
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Categoria</th>
                                    <th>Estoque Atual</th>
                                    <th>Estoque Mínimo</th>
                                    <th>Status</th>
                                    <th>Utilização</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($estoque as $item): ?>
                                <tr>
                                    <td><strong><i class="fas fa-box"></i> <?php echo $item['nome']; ?></strong></td>
                                    <td><?php echo $item['categoria']; ?></td>
                                    <td><?php echo $item['quantidade']; ?> <?php echo $item['unidade_medida']; ?></td>
                                    <td><?php echo $item['estoque_minimo']; ?> <?php echo $item['unidade_medida']; ?></td>
                                    <td>
                                        <?php if($item['status'] == 'crítico'): ?>
                                            <span class="status-critical"><i class="fas fa-exclamation-circle"></i> Crítico</span>
                                        <?php elseif($item['status'] == 'baixo'): ?>
                                            <span class="status-low"><i class="fas fa-exclamation-triangle"></i> Baixo</span>
                                        <?php else: ?>
                                            <span class="status-normal"><i class="fas fa-check-circle"></i> Normal</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $percentual = min(100, ($item['quantidade'] / ($item['estoque_minimo'] * 2)) * 100);
                                        $barClass = $item['status'] == 'crítico' ? 'progress-bar-critical' : ($item['status'] == 'baixo' ? 'progress-bar-low' : 'progress-bar-normal');
                                        ?>
                                        <div class="progress">
                                            <div class="progress-bar <?php echo $barClass; ?>" style="width: <?php echo $percentual; ?>%"></div>
                                        </div>
                                        <small><?php echo round($percentual); ?>% do estoque mínimo</small>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                <strong>Dica:</strong> Quando o estoque atingir o nível mínimo, entre em contato com os fornecedores para fazer um novo pedido.
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>