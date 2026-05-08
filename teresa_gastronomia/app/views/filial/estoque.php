<?php
$page_title = 'Controle de Estoque';
$page_subtitle = 'Gerencie o estoque da sua filial';
$active_menu = 'estoque';
include __DIR__ . '/../layout/header.php';
?>

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
                                    <span class="badge badge-danger">Crítico</span>
                                <?php elseif($item['status'] == 'baixo'): ?>
                                    <span class="badge badge-warning">Baixo</span>
                                <?php else: ?>
                                    <span class="badge badge-success">Normal</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                $percentual = min(100, ($item['quantidade'] / ($item['estoque_minimo'] * 2)) * 100);
                                $barClass = $item['status'] == 'crítico' ? 'progress-bar-danger' : ($item['status'] == 'baixo' ? 'progress-bar-warning' : 'progress-bar-success');
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
        <i class="fas fa-lightbulb"></i> 
        <strong>Dica:</strong> Quando o estoque atingir o nível mínimo, solicite um pedido ao fornecedor.
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>