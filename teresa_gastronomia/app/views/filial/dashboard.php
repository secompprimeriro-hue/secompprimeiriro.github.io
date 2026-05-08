<?php
$page_title = 'Dashboard da Filial';
$page_subtitle = 'Visão geral da sua unidade';
$active_menu = 'dashboard';
include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-primary-card">
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
                <div class="stats-icon bg-success-card">
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
                <div class="stats-icon bg-warning-card">
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
                <div class="stats-icon bg-danger-card">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stats-info">
                    <h3><?php echo count(array_filter($estoque, fn($e) => $e['quantidade'] <= $e['estoque_minimo'])); ?></h3>
                    <p>Alertas de Estoque</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="fas fa-chart-line"></i> Vendas - Últimos 7 Dias</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="vendasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><i class="fas fa-chart-pie"></i> Produtos Mais Vendidos</div>
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
                <div class="card-header"><i class="fas fa-trophy"></i> Top Produtos</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead><tr><th>Produto</th><th>Qtd</th><th>Receita</th></tr></thead>
                            <tbody>
                                <?php foreach($topProdutos as $p): ?>
                                <tr><td><?php echo $p['nome']; ?></td><td><?php echo $p['quantidade']; ?></td><td>R$ <?php echo number_format($p['receita'],2); ?></td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><i class="fas fa-boxes"></i> Níveis de Estoque</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead><tr><th>Produto</th><th>Estoque</th><th>Status</th></tr></thead>
                            <tbody>
                                <?php foreach($estoque as $item): ?>
                                <tr>
                                    <td><?php echo $item['nome']; ?></td>
                                    <td><?php echo $item['quantidade']; ?> <?php echo $item['unidade_medida']; ?></td>
                                    <td>
                                        <?php if($item['quantidade'] <= $item['estoque_minimo']): ?>
                                            <span class="badge badge-danger">Crítico</span>
                                        <?php elseif($item['quantidade'] <= $item['estoque_minimo'] * 2): ?>
                                            <span class="badge badge-warning">Baixo</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Normal</span>
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

<script>
    const vendasData = <?php echo json_encode($vendasPorDia); ?>;
    new Chart(document.getElementById('vendasChart'), {
        type: 'line', data: { labels: vendasData.map(i => i.data), datasets: [{ label: 'Vendas (R$)', data: vendasData.map(i => i.total), borderColor: '#2d6a4f', fill: true, tension: 0.4 }] },
        options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
    });
    const produtosData = <?php echo json_encode($topProdutos); ?>;
    new Chart(document.getElementById('produtosChart'), {
        type: 'doughnut', data: { labels: produtosData.map(i => i.nome), datasets: [{ data: produtosData.map(i => i.quantidade), backgroundColor: ['#2d6a4f', '#40916c', '#52b788', '#74c69d'] }] },
        options: { responsive: true, maintainAspectRatio: false }
    });
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>