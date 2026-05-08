<?php
$page_title = 'Dashboard Matriz';
$page_subtitle = 'Visão geral do negócio';
$active_menu = 'dashboard';
include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="stats-card" onclick="location.href='index.php?action=matriz_filiais'">
                <div class="stats-icon bg-primary-card"><i class="fas fa-store"></i></div>
                <div class="stats-info">
                    <h3><?php echo $totalFiliais['total'] ?? 0; ?></h3>
                    <p>Filiais Ativas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-success-card"><i class="fas fa-truck"></i></div>
                <div class="stats-info">
                    <h3><?php echo $totalFornecedores['total'] ?? 0; ?></h3>
                    <p>Fornecedores</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-warning-card"><i class="fas fa-chart-line"></i></div>
                <div class="stats-info">
                    <h3>R$ <?php echo number_format($vendasMes['total'] ?? 0, 2); ?></h3>
                    <p>Vendas no Mês</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-danger-card"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="stats-info">
                    <h3><?php echo count($alertasEstoque ?? []); ?></h3>
                    <p>Alertas de Estoque</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="fas fa-chart-line"></i> Evolução das Vendas - Últimos 30 Dias</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="vendasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><i class="fas fa-chart-pie"></i> Vendas por Filial</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><i class="fas fa-trophy"></i> Top Produtos do Mês</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead><tr><th>Produto</th><th>Qtd</th><th>Receita</th><th>%</th></tr></thead>
                            <tbody>
                                <?php foreach($topProdutos as $index => $produto): ?>
                                <tr>
                                    <td><?php echo $index == 0 ? '🥇 ' : ($index == 1 ? '🥈 ' : ($index == 2 ? '🥉 ' : '📦 ')); ?><?php echo $produto['nome']; ?></td>
                                    <td><?php echo $produto['quantidade']; ?> und</td>
                                    <td>R$ <?php echo number_format($produto['receita'], 2); ?></td>
                                    <td><div class="progress"><div class="progress-bar" style="width: <?php echo ($produto['quantidade'] / max(1, $topProdutos[0]['quantidade'])) * 100; ?>%; background: #2d6a4f;"></div></div></td>
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
                <div class="card-header"><i class="fas fa-exclamation-triangle"></i> Alertas de Estoque</div>
                <div class="card-body">
                    <?php if(count($alertasEstoque) > 0): ?>
                        <?php foreach($alertasEstoque as $alerta): ?>
                        <div class="alert alert-warning">
                            <strong><?php echo $alerta['filial']; ?></strong><br>
                            <?php echo $alerta['produto']; ?>: <?php echo $alerta['quantidade']; ?> (mínimo <?php echo $alerta['estoque_minimo']; ?>)
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-success text-center">✅ Nenhum alerta de estoque</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const vendasData = <?php echo json_encode($vendasPorDia); ?>;
new Chart(document.getElementById('vendasChart'), {
    type: 'line',
    data: { labels: vendasData.map(i => i.data), datasets: [{ label: 'Vendas (R$)', data: vendasData.map(i => i.total), borderColor: '#2d6a4f', backgroundColor: 'rgba(45,106,79,0.1)', fill: true, tension: 0.4 }] },
    options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, ticks: { callback: v => 'R$ ' + v.toLocaleString() } } } }
});
const pieData = <?php echo json_encode($vendasPorFilial); ?>;
new Chart(document.getElementById('pieChart'), {
    type: 'doughnut',
    data: { labels: pieData.map(i => i.nome), datasets: [{ data: pieData.map(i => i.total), backgroundColor: ['#2d6a4f', '#40916c', '#52b788', '#74c69d'] }] },
    options: { responsive: true, maintainAspectRatio: false }
});
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>