<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Filial Teresa Gastronomia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
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
        .sidebar-menu a:hover { background: rgba(255,255,255,0.1); color: white; transform: translateX(5px); }
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
        
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        .stats-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }
        
        .bg-primary-gradient { background: linear-gradient(135deg, #667eea, #764ba2); color: white; }
        .bg-success-gradient { background: linear-gradient(135deg, #84fab0, #8fd3f4); color: white; }
        .bg-warning-gradient { background: linear-gradient(135deg, #ffe259, #ffa751); color: white; }
        .bg-danger-gradient { background: linear-gradient(135deg, #ff6b6b, #ee5a24); color: white; }
        
        .card { border: none; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .card-header { background: white; border-bottom: 2px solid #f0f0f0; padding: 20px; font-weight: 600; }
        .chart-container { position: relative; height: 300px; padding: 20px; }
        
        .status-critical { background: #f8d7da; color: #721c24; padding: 3px 10px; border-radius: 20px; font-size: 12px; }
        .status-low { background: #fff3cd; color: #856404; padding: 3px 10px; border-radius: 20px; font-size: 12px; }
        .status-normal { background: #d4edda; color: #155724; padding: 3px 10px; border-radius: 20px; font-size: 12px; }
        
        @media (max-width: 768px) { .sidebar { margin-left: -260px; } .main-content { margin-left: 0; } }
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
            <a href="index.php?action=filial_dashboard" class="active">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a href="index.php?action=filial_vendas">
                <i class="fas fa-cash-register"></i> Registrar Vendas
            </a>
            <a href="index.php?action=filial_fornecedores">
                <i class="fas fa-truck"></i> Fornecedores
            </a>
            <a href="index.php?action=filial_pedidos">
                <i class="fas fa-shopping-cart"></i> Pedidos
            </a>
            <a href="index.php?action=filial_estoque">
                <i class="fas fa-boxes"></i> Estoque
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h2>Dashboard da Filial</h2>
                <p>Visão geral da sua unidade</p>
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
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-primary-gradient">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stats-info">
                            <h3>R$ <?php echo number_format($vendasMes['total'] ?? 0, 2); ?></h3>
                            <p>Vendas no Mês</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-success-gradient">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="stats-info">
                            <h3><?php echo $vendasMes['quantidade'] ?? 0; ?></h3>
                            <p>Vendas Realizadas</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-warning-gradient">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="stats-info">
                            <h3><?php echo count($estoque); ?></h3>
                            <p>Produtos em Estoque</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-danger-gradient">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stats-info">
                            <h3><?php echo count(array_filter($estoque, function($e) { return $e['quantidade'] <= $e['estoque_minimo']; })); ?></h3>
                            <p>Alertas de Estoque</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-line"></i> Vendas - Últimos 7 Dias
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="vendasChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-pie"></i> Produtos Mais Vendidos
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="produtosChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-trophy"></i> Top Produtos
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Receita</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($topProdutos as $produto): ?>
                                        <tr>
                                            <td><strong><?php echo $produto['nome']; ?></strong></td>
                                            <td><?php echo $produto['quantidade']; ?> und</td>
                                            <td>R$ <?php echo number_format($produto['receita'], 2); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
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
                                            <th>Estoque</th>
                                            <th>Mínimo</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($estoque as $item): ?>
                                        <tr>
                                            <td><?php echo $item['nome']; ?></td>
                                            <td><?php echo $item['quantidade']; ?> <?php echo $item['unidade_medida']; ?></td>
                                            <td><?php echo $item['estoque_minimo']; ?></td>
                                            <td>
                                                <?php if($item['quantidade'] <= $item['estoque_minimo']): ?>
                                                    <span class="status-critical">Crítico</span>
                                                <?php elseif($item['quantidade'] <= $item['estoque_minimo'] * 2): ?>
                                                    <span class="status-low">Baixo</span>
                                                <?php else: ?>
                                                    <span class="status-normal">Normal</span>
                                                <?php endif; ?>
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
        </div>
    </div>

    <script>
        const vendasData = <?php echo json_encode($vendasPorDia); ?>;
        const ctx = document.getElementById('vendasChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: vendasData.map(item => item.data),
                datasets: [{
                    label: 'Vendas (R$)',
                    data: vendasData.map(item => item.total),
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { callback: function(v) { return 'R$ ' + v; } } }
                }
            }
        });

        const produtosData = <?php echo json_encode($topProdutos); ?>;
        const pieCtx = document.getElementById('produtosChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: produtosData.map(item => item.nome),
                datasets: [{
                    data: produtosData.map(item => item.quantidade),
                    backgroundColor: ['#667eea', '#84fab0', '#ffe259', '#ff6b6b', '#4ecdc4']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>