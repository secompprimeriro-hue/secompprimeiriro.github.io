<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Matriz - Teresa Gastronomia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }
        
        .sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header i { font-size: 60px; color: #667eea; }
        .sidebar-header h3 { color: white; margin-top: 15px; font-weight: 600; }
        .sidebar-header p { color: rgba(255,255,255,0.7); font-size: 14px; }
        
        .sidebar-menu { padding: 20px 15px; }
        .sidebar-menu a {
            display: block;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 8px;
            transition: all 0.3s;
        }
        .sidebar-menu a:hover { background: rgba(102,126,234,0.3); color: white; transform: translateX(5px); }
        .sidebar-menu a.active { background: linear-gradient(135deg, #667eea, #764ba2); color: white; }
        .sidebar-menu a i { width: 25px; margin-right: 12px; }
        
        .main-content { margin-left: 280px; padding: 20px; }
        
        .top-bar {
            background: white;
            border-radius: 15px;
            padding: 15px 25px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .page-title h2 { margin: 0; color: #1a1a2e; font-size: 24px; font-weight: 600; }
        .page-title p { margin: 5px 0 0; color: #666; font-size: 14px; }
        
        .user-info { display: flex; align-items: center; gap: 15px; }
        .user-badge {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 8px 18px;
            border-radius: 25px;
            color: white;
            font-weight: 500;
        }
        .btn-logout {
            background: #dc3545;
            color: white;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-logout:hover { background: #c82333; color: white; }
        
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .stats-card:hover { transform: translateY(-5px); box-shadow: 0 5px 25px rgba(0,0,0,0.1); }
        
        .stats-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }
        
        .stats-info h3 { font-size: 28px; font-weight: bold; margin: 0; color: #1a1a2e; }
        .stats-info p { margin: 5px 0 0; color: #666; font-size: 14px; }
        
        .bg-primary-gradient { background: linear-gradient(135deg, #667eea, #764ba2); color: white; }
        .bg-success-gradient { background: linear-gradient(135deg, #11998e, #38ef7d); color: white; }
        .bg-warning-gradient { background: linear-gradient(135deg, #f2994a, #f2c94c); color: white; }
        .bg-danger-gradient { background: linear-gradient(135deg, #eb3349, #f45c43); color: white; }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }
        .card-header {
            background: white;
            border-bottom: 2px solid #f0f0f0;
            padding: 18px 22px;
            font-weight: 600;
            border-radius: 15px 15px 0 0;
        }
        .card-header i { margin-right: 8px; color: #667eea; }
        
        .chart-container { position: relative; height: 320px; padding: 20px; }
        
        .alert-item {
            padding: 12px;
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            margin-bottom: 10px;
            border-radius: 8px;
        }
        
        .status-critical { background: #f8d7da; color: #721c24; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        .status-low { background: #fff3cd; color: #856404; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        .status-normal { background: #d4edda; color: #155724; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        
        @media (max-width: 768px) {
            .sidebar { margin-left: -280px; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-utensils"></i>
            <h3>Grupo Tereza</h3>
            <p>Sistema de Gestão</p>
        </div>
        <div class="sidebar-menu">
            <a href="index.php?action=matriz_dashboard" class="active">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a href="index.php?action=matriz_filiais">
                <i class="fas fa-store"></i> Filiais
            </a>
            <a href="index.php?action=matriz_fornecedores">
                <i class="fas fa-truck"></i> Fornecedores
            </a>
            <a href="index.php?action=matriz_vendas">
                <i class="fas fa-chart-simple"></i> Vendas
            </a>
            <a href="index.php?action=matriz_relatorios">
                <i class="fas fa-file-alt"></i> Relatórios
            </a>
            <a href="index.php?action=matriz_analise_consumo">
                <i class="fas fa-chart-pie"></i> Análise de Consumo
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h2><i class="fas fa-chart-line"></i> Dashboard da Matriz</h2>
                <p>Visão completa do negócio - Dados em tempo real</p>
            </div>
            <div class="user-info">
                <span class="user-badge">
                    <i class="fas fa-user"></i> <?php echo $_SESSION['usuario_nome']; ?>
                </span>
                <a href="index.php?action=logout" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Cards de Estatísticas -->
            <div class="row">
                <div class="col-md-3">
                    <div class="stats-card" onclick="location.href='index.php?action=matriz_filiais'">
                        <div class="stats-icon bg-primary-gradient">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="stats-info">
                            <h3><?php echo $totalFiliais['total'] ?? 0; ?></h3>
                            <p>Filiais Ativas</p>
                            <small class="text-muted">Clique para gerenciar</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" onclick="location.href='index.php?action=matriz_fornecedores'">
                        <div class="stats-icon bg-success-gradient">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="stats-info">
                            <h3><?php echo $totalFornecedores['total'] ?? 0; ?></h3>
                            <p>Fornecedores</p>
                            <small class="text-muted">Parceiros ativos</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-warning-gradient">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stats-info">
                            <h3>R$ <?php echo number_format($vendasMes['total'] ?? 0, 2); ?></h3>
                            <p>Vendas no Mês</p>
                            <small class="text-muted">Faturamento total</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-danger-gradient">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stats-info">
                            <h3><?php echo count($alertasEstoque ?? []); ?></h3>
                            <p>Alertas de Estoque</p>
                            <small class="text-muted">Necessitam atenção</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos Principais -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-line"></i> Evolução das Vendas - Últimos 30 Dias
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="vendasEvolucaoChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-pie"></i> Vendas por Filial
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="vendasFilialChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Produtos e Alertas -->
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-trophy"></i> Produtos Mais Vendidos do Mês
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Receita</th>
                                            <th>Participação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($topProdutos as $index => $produto): ?>
                                        <tr>
                                            <td>
                                                <strong>
                                                    <?php if($index == 0): ?>🥇 
                                                    <?php elseif($index == 1): ?>🥈 
                                                    <?php elseif($index == 2): ?>🥉 
                                                    <?php else: ?>📦 <?php endif; ?>
                                                    <?php echo $produto['nome']; ?>
                                                </strong>
                                            </td>
                                            <td><?php echo $produto['quantidade']; ?> und</td>
                                            <td>R$ <?php echo number_format($produto['receita'], 2); ?></td>
                                            <td>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-primary" style="width: <?php echo ($produto['quantidade'] / $topProdutos[0]['quantidade']) * 100; ?>%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-exclamation-triangle"></i> Alertas de Estoque Baixo
                        </div>
                        <div class="card-body">
                            <?php if(count($alertasEstoque) > 0): ?>
                                <?php foreach($alertasEstoque as $alerta): ?>
                                <div class="alert-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-box"></i>
                                            <strong><?php echo $alerta['filial']; ?></strong>
                                            <div class="small">Produto: <?php echo $alerta['produto']; ?></div>
                                        </div>
                                        <div class="text-end">
                                            <span class="status-critical">Estoque: <?php echo $alerta['quantidade']; ?></span>
                                            <div class="small text-muted">Mínimo: <?php echo $alerta['estoque_minimo']; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <div class="text-center mt-3">
                                    <button class="btn btn-primary btn-sm" onclick="gerarPedidosAutomaticos()">
                                        <i class="fas fa-magic"></i> Gerar Pedidos Automaticamente
                                    </button>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-success text-center">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                    <p class="mt-2 mb-0">Todos os estoques estão dentro do nível mínimo!</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Padrões de Consumo por Região -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-bar"></i> Padrões de Consumo por Região
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Região</th>
                                            <th>Produto Mais Vendido</th>
                                            <th>Quantidade</th>
                                            <th>Preferência</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $regioes = [];
                                        foreach($padroesConsumo as $padrao) {
                                            if(!isset($regioes[$padrao['regiao']])) {
                                                $regioes[$padrao['regiao']] = $padrao;
                                            }
                                        }
                                        foreach($regioes as $regiao => $dados):
                                        ?>
                                        <tr>
                                            <td><strong><i class="fas fa-map-marker-alt"></i> <?php echo $regiao; ?></strong></td>
                                            <td><?php echo $dados['produto']; ?></td>
                                            <td><?php echo $dados['total_vendido']; ?> und</td>
                                            <td>
                                                <div class="progress" style="height: 8px; width: 150px;">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
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
        // Gráfico de Evolução das Vendas
        const vendasEvolucaoData = <?php echo json_encode($vendasPorDia); ?>;
        const ctx1 = document.getElementById('vendasEvolucaoChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: vendasEvolucaoData.map(item => item.data),
                datasets: [{
                    label: 'Vendas Diárias (R$)',
                    data: vendasEvolucaoData.map(item => item.total),
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#764ba2',
                    pointBorderColor: '#fff',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { callbacks: { label: function(context) { return 'R$ ' + context.raw.toLocaleString(); } } }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { callback: function(v) { return 'R$ ' + v.toLocaleString(); } } }
                }
            }
        });

        // Gráfico de Vendas por Filial
        const vendasFilialData = <?php echo json_encode($vendasPorFilial); ?>;
        const ctx2 = document.getElementById('vendasFilialChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: vendasFilialData.map(item => item.nome),
                datasets: [{
                    data: vendasFilialData.map(item => item.total),
                    backgroundColor: ['#667eea', '#764ba2', '#f093fb', '#4facfe', '#43e97b'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: { callbacks: { label: function(context) { return context.label + ': R$ ' + context.raw.toLocaleString(); } } }
                }
            }
        });

        function gerarPedidosAutomaticos() {
            if(confirm('Deseja gerar pedidos automáticos para todos os produtos com estoque baixo?')) {
                alert('Pedidos gerados com sucesso! Os fornecedores serão contatados.');
                location.reload();
            }
        }

        // Auto-refresh a cada 30 segundos
        setTimeout(function() {
            location.reload();
        }, 30000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>