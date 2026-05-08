<?php
$page_title = 'Ranking de Desempenho';
$page_subtitle = 'Classificação das filiais por faturamento';
$active_menu = 'ranking';
include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <!-- Ranking Principal -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-trophy"></i> Ranking do Mês - <?php echo date('m/Y'); ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Posição</th>
                            <th>Filial</th>
                            <th>Vendas Realizadas</th>
                            <th>Ticket Médio</th>
                            <th>Faturamento Total</th>
                            <th>Desempenho</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rankingFiliais as $index => $filial): 
                            $medalha = '';
                            $bgClass = '';
                            if($index == 0) {
                                $medalha = '🥇';
                                $bgClass = 'style="background: linear-gradient(135deg, #ffd700, #ffed4e);"';
                            } elseif($index == 1) {
                                $medalha = '🥈';
                                $bgClass = 'style="background: linear-gradient(135deg, #c0c0c0, #e8e8e8);"';
                            } elseif($index == 2) {
                                $medalha = '🥉';
                                $bgClass = 'style="background: linear-gradient(135deg, #cd7f32, #e8a870);"';
                            }
                        ?>
                        <tr <?php echo $bgClass; ?>>
                            <td>
                                <?php if($medalha): ?>
                                    <span style="font-size: 24px;"><?php echo $medalha; ?></span>
                                <?php else: ?>
                                    <span class="badge bg-primary">#<?php echo $index + 1; ?></span>
                                <?php endif; ?>
                            </td>
                            <td><strong><?php echo $filial['nome']; ?></strong></td>
                            <td><?php echo $filial['quantidade_vendas']; ?> vendas</td>
                            <td>R$ <?php echo number_format($filial['ticket_medio'], 2); ?></td>
                            <td class="fw-bold">R$ <?php echo number_format($filial['vendas'], 2); ?></td>
                            <td>
                                <div class="progress" style="width: 120px;">
                                    <div class="progress-bar" style="width: <?php echo ($filial['vendas'] / max(1, $rankingFiliais[0]['vendas'])) * 100; ?>%; background: #2d6a4f;"></div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Gráficos Comparativos -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-bar"></i> Metas vs Realizado
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="metasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-line"></i> Participação no Faturamento
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="participacaoChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premiações -->
    <div class="alert alert-success mt-3">
        <i class="fas fa-gift"></i> 
        <strong>🏆 Premiação do Mês:</strong> 
        A filial <strong><?php echo $rankingFiliais[0]['nome'] ?? 'Matriz'; ?></strong> receberá um bônus de R$ 5.000,00 pelo excelente desempenho!
    </div>
</div>

<script>
// Gráfico de Metas vs Realizado
const metasData = <?php echo json_encode($rankingFiliais); ?>;
new Chart(document.getElementById('metasChart'), {
    type: 'bar',
    data: {
        labels: metasData.map(i => i.nome),
        datasets: [
            {
                label: 'Realizado (R$)',
                data: metasData.map(i => i.vendas),
                backgroundColor: '#2d6a4f',
                borderRadius: 8
            },
            {
                label: 'Meta (R$)',
                data: metasData.map(i => i.vendas * 1.2),
                backgroundColor: '#ff9f1c',
                borderRadius: 8
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { tooltip: { callbacks: { label: (ctx) => 'R$ ' + ctx.raw.toLocaleString() } } }
    }
});

// Gráfico de Participação
new Chart(document.getElementById('participacaoChart'), {
    type: 'doughnut',
    data: {
        labels: metasData.map(i => i.nome),
        datasets: [{
            data: metasData.map(i => i.vendas),
            backgroundColor: ['#2d6a4f', '#40916c', '#52b788', '#74c69d', '#95d5b2']
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>