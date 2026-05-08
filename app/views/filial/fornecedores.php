<?php
$page_title = 'Fornecedores Disponíveis';
$page_subtitle = 'Fornecedores que atendem sua região';
$active_menu = 'fornecedores';
include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php foreach($fornecedores as $fornecedor): ?>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stats-icon bg-primary-card" style="width: 50px; height: 50px;">
                            <i class="fas fa-truck"></i>
                        </div>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pedidoModal<?php echo $fornecedor['id']; ?>">
                            <i class="fas fa-shopping-cart"></i> Solicitar Pedido
                        </button>
                    </div>
                    <h5><?php echo $fornecedor['nome']; ?></h5>
                    <p class="small text-muted">
                        <i class="fas fa-user"></i> Representante: <?php echo $fornecedor['nome_representante']; ?><br>
                        <i class="fas fa-envelope"></i> <?php echo $fornecedor['email']; ?><br>
                        <i class="fas fa-phone"></i> <?php echo $fornecedor['telefone']; ?><br>
                        <i class="fas fa-map-marker-alt"></i> <?php echo $fornecedor['localizacao']; ?><br>
                        <i class="fas fa-tag"></i> Ramo: <?php echo $fornecedor['ramo_alimenticio']; ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Modal Pedido -->
        <div class="modal fade" id="pedidoModal<?php echo $fornecedor['id']; ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Solicitar Pedido - <?php echo $fornecedor['nome']; ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="index.php?action=filial_criar_pedido" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="fornecedor_id" value="<?php echo $fornecedor['id']; ?>">
                            <div class="form-group">
                                <label class="form-label">Observações</label>
                                <textarea class="form-control" name="observacao" rows="3" placeholder="Descreva os insumos que precisa..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Enviar Pedido</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>