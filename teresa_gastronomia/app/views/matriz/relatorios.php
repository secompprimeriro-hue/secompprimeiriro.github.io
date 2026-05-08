<?php
$page_title = 'Relatórios Gerenciais';
$page_subtitle = 'Análise completa do desempenho do negócio';
$active_menu = 'relatorios';
include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <!-- Relatório de Vendas por Filial -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-chart-bar"></i> Vendas por Filial - <?php echo date('m/Y'); ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Filial</th>
                            <th>Quantidade de Vendas</th>
                            <th>Ticket Médio</th>
                            <th>Faturamento Total</th>
                            <th>Participação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalGeral = array_sum(array_column($vendasPorFilial, 'total_vendas'));
                        foreach($vendasPorFilial as $filial): 
                            $percentual = $totalGeral > 0 ? ($filial['total_vendas'] / $totalGeral) * 100 : 0;
                        ?>
                        <tr>
                            <td><strong><?php echo $filial['nome']; ?></strong></td>
                            <td><?php echo $filial['quantidade_vendas']; ?></td>
                            <td>R$ <?php echo number_format($filial['ticket_medio'], 2); ?></td>
                            <td class="fw-bold">R$ <?php echo number_format($filial['total_vendas'], 2); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1" style="width: 100px;">
                                        <div class="progress-bar" style="width: <?php echo $percentual; ?>%; background: #2d6a4f;"></div>
                                    </div>
                                    <small><?php echo round($percentual, 1); ?>%</small>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-secondary">
                        <tr>
                            <th>TOTAL</th>
                            <th><?php echo array_sum(array_column($vendasPorFilial, 'quantidade_vendas')); ?></th>
                            <th>R$ <?php echo number_format(array_sum(array_column($vendasPorFilial, 'total_vendas')) / max(1, array_sum(array_column($vendasPorFilial, 'quantidade_vendas'))), 2); ?></th>
                            <th>R$ <?php echo number_format($totalGeral, 2); ?></th>
                            <th>100%</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Top Produtos -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-trophy"></i> Top 10 Produtos Mais Vendidos
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Quantidade Vendida</th>
                            <th>Receita Total</th>
                            <th>% do Faturamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $receitaTotal = array_sum(array_column($produtosMaisVendidos, 'receita'));
                        foreach($produtosMaisVendidos as $index => $produto): 
                            $percentual = $receitaTotal > 0 ? ($produto['receita'] / $receitaTotal) * 100 : 0;
                        ?>
                        <tr>
                            <td><span class="badge bg-primary"><?php echo $index + 1; ?>º</span></td>
                            <td><strong><?php echo $produto['nome']; ?></strong></td>
                            <td><?php echo $produto['categoria']; ?></td>
                            <td><?php echo $produto['total_vendido']; ?> und</td>
                            <td>R$ <?php echo number_format($produto['receita'], 2); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1" style="width: 100px;">
                                        <div class="progress-bar" style="width: <?php echo $percentual; ?>%; background: #ff9f1c;"></div>
                                    </div>
                                    <small><?php echo round($percentual, 1); ?>%</small>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="alert alert-info">
        <i class="fas fa-download"></i> 
        <strong>Exportar Relatórios:</strong> 
        <button class="btn btn-sm btn-primary ms-2" onclick="exportarCSV()">
            <i class="fas fa-file-csv"></i> Exportar CSV
        </button>
    </div>
</div>

<script>
function exportarCSV() {
    alert('Funcionalidade em desenvolvimento - Exportação CSV será implementada em breve');
}
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>