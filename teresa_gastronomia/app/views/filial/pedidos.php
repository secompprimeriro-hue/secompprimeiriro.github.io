<?php
$page_title = 'Meus Pedidos';
$page_subtitle = 'Acompanhe o status dos seus pedidos';
$active_menu = 'pedidos';
include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <i class="fas fa-shopping-cart"></i> Histórico de Pedidos
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fornecedor</th>
                            <th>Data do Pedido</th>
                            <th>Status</th>
                            <th>Valor Total</th>
                            <th>Observações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pedidos as $pedido): ?>
                        <tr>
                            <td>#<?php echo $pedido['id']; ?></td>
                            <td><strong><?php echo $pedido['fornecedor']; ?></strong></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?></td>
                            <td>
                                <?php
                                $statusClass = '';
                                $statusText = '';
                                switch($pedido['status']) {
                                    case 'pendente': $statusClass = 'badge-warning'; $statusText = 'Pendente'; break;
                                    case 'aprovado': $statusClass = 'badge-info'; $statusText = 'Aprovado'; break;
                                    case 'entregue': $statusClass = 'badge-success'; $statusText = 'Entregue'; break;
                                    default: $statusClass = 'badge-secondary'; $statusText = ucfirst($pedido['status']);
                                }
                                ?>
                                <span class="badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                            </td>
                            <td>R$ <?php echo number_format($pedido['valor_total'] ?? 0, 2); ?></td>
                            <td><?php echo $pedido['observacao']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="alert alert-info mt-3">
        <i class="fas fa-info-circle"></i> 
        <strong>Informação:</strong> Os pedidos são processados em até 48 horas úteis.
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>