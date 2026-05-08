<?php
$page_title = 'Relatório de Vendas';
$page_subtitle = 'Acompanhe todas as vendas em tempo real';
$active_menu = 'vendas';
include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <!-- Resumo de Vendas -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon bg-primary-card">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stats-info">
                    <h3>R$ <?php echo number_format($resumoVendas['total_geral'] ?? 0, 2); ?></h3>
                    <p>Faturamento Total do Mês</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon bg-success-card">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="stats-info">
                    <h3><?php echo $resumoVendas['total_vendas'] ?? 0; ?></h3>
                    <p>Total de Vendas</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon bg-warning-card">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <div class="stats-info">
                    <h3>R$ <?php echo number_format($resumoVendas['ticket_medio'] ?? 0, 2); ?></h3>
                    <p>Ticket Médio</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Vendas Diárias -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-line"></i> Vendas por Dia - Últimos 30 Dias
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="vendasDiariasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-pie"></i> Distribuição por Filial
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="distribuicaoChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimas Vendas -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-history"></i> Últimas Vendas Realizadas
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Data/Hora</th>
                            <th>Filial</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor Unitário</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($vendas as $venda): ?>
                        <tr>
                            <td><?php echo date('d/m/Y H:i', strtotime($venda['data_venda'])); ?></td>
                            <td><span class="badge bg-primary"><?php echo $venda['filial']; ?></span></td>
                            <td><strong><?php echo $venda['produto']; ?></strong></td>
                            <td><?php echo $venda['quantidade']; ?></td>
                            <td>R$ <?php echo number_format($venda['valor_unitario'], 2); ?></td>
                            <td class="fw-bold">R$ <?php echo number_format($venda['valor_total'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Gráfico de Vendas Diárias
const vendasData = <?php echo json_encode($vendasPorDia); ?>;
new Chart(document.getElementById('vendasDiariasChart'), {
    type: 'line',
    data: {
        labels: vendasData.map(i => i.data),
        datasets: [{
            label: 'Vendas Diárias (R$)',
            data: vendasData.map(i => i.total),
            borderColor: '#2d6a4f',
            backgroundColor: 'rgba(45,106,79,0.1)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true, ticks: { callback: v => 'R$ ' + v.toLocaleString() } } }
    }
});

// Gráfico de Distribuição
const pieData = <?php echo json_encode($vendasPorFilial); ?>;
new Chart(document.getElementById('distribuicaoChart'), {
    type: 'doughnut',
    data: {
        labels: pieData.map(i => i.nome),
        datasets: [{
            data: pieData.map(i => i.total),
            backgroundColor: ['#2d6a4f', '#40916c', '#52b788', '#74c69d']
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>