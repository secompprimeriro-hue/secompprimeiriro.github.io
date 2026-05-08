<?php
$page_title = 'Análise de Consumo';
$page_subtitle = 'Padrões de consumo por filial e região';
$active_menu = 'analise';
include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <!-- Resumo da Análise -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon bg-primary-card">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stats-info">
                    <h3><?php echo count(array_unique(array_column($analise, 'filial'))); ?></h3>
                    <p>Filiais Analisadas</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon bg-success-card">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stats-info">
                    <h3><?php echo count($analise); ?></h3>
                    <p>Produtos Analisados</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon bg-warning-card">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div class="stats-info">
                    <h3><?php echo count(array_unique(array_column($analise, 'regiao'))); ?></h3>
                    <p>Regiões Atendidas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabela de Análise -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-chart-bar"></i> Produtos Mais Vendidos por Filial
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Filial</th>
                            <th>Região</th>
                            <th>Produto Mais Vendido</th>
                            <th>Quantidade</th>
                            <th>Receita</th>
                            <th>Participação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $filialAtual = '';
                        foreach($analise as $item):
                            if($filialAtual != $item['filial']):
                                $filialAtual = $item['filial'];
                        ?>
                        <tr style="background: rgba(45,106,79,0.05);">
                            <td><strong><i class="fas fa-store"></i> <?php echo $item['filial']; ?></strong></td>
                            <td><span class="badge bg-info"><?php echo $item['regiao']; ?></span></td>
                            <td><strong><?php echo $item['produto']; ?></strong></td>
                            <td><?php echo $item['quantidade_vendida']; ?> und</td>
                            <td>R$ <?php echo number_format($item['receita'], 2); ?></td>
                            <td>
                                <div class="progress" style="width: 100px;">
                                    <div class="progress-bar" style="width: 100%; background: #2d6a4f;"></div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Gráfico de Consumo por Região -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-pie"></i> Consumo por Região
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="consumoRegiaoChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-lightbulb"></i> Insights e Recomendações
                </div>
                <div class="card-body">
                    <div class="alert alert-success mb-3">
                        <i class="fas fa-chart-line"></i> 
                        <strong>Produto Destaque:</strong> Carne de Sol é líder em todas as regiões
                    </div>
                    <div class="alert alert-warning mb-3">
                        <i class="fas fa-box"></i> 
                        <strong>Otimização:</strong> Aumentar estoque de Queijo Coalho no Centro-Sul
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-chart-pie"></i> 
                        <strong>Sazonalidade:</strong> Consumo de carnes aumenta 30% nos finais de semana
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Gráfico de Consumo por Região
const regioes = {};
<?php foreach($analise as $item): ?>
    regioes['<?php echo $item['regiao']; ?>'] = (regioes['<?php echo $item['regiao']; ?>'] || 0) + <?php echo $item['quantidade_vendida']; ?>;
<?php endforeach; ?>

new Chart(document.getElementById('consumoRegiaoChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(regioes),
        datasets: [{
            label: 'Quantidade Vendida',
            data: Object.values(regioes),
            backgroundColor: '#2d6a4f',
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
    }
});
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>