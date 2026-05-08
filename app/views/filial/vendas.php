<?php
$page_title = 'Registrar Vendas';
$page_subtitle = 'Registre as vendas da sua filial';
$active_menu = 'vendas';
include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-plus-circle"></i> Nova Venda
                </div>
                <div class="card-body">
                    <?php if(isset($_SESSION['mensagem'])): ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="index.php?action=filial_registrar_venda" method="POST">
                        <div class="form-group">
                            <label class="form-label">Produto</label>
                            <select class="form-select" name="produto_id" required>
                                <option value="">Selecione um produto</option>
                                <?php foreach($produtos as $produto): ?>
                                <option value="<?php echo $produto['id']; ?>">
                                    <?php echo $produto['nome']; ?> - R$ <?php echo number_format($produto['preco_venda'], 2); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Quantidade</label>
                            <input type="number" class="form-control" name="quantidade" required min="1">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-check"></i> Registrar Venda
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-history"></i> Últimas Vendas
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Valor Unitário</th>
                                    <th>Total</th>
                                    <th>Data/Hora</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($vendas as $venda): ?>
                                <tr>
                                    <td><strong><?php echo $venda['produto']; ?></strong></td>
                                    <td><?php echo $venda['quantidade']; ?></td>
                                    <td>R$ <?php echo number_format($venda['valor_unitario'], 2); ?></td>
                                    <td>R$ <?php echo number_format($venda['valor_total'], 2); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($venda['data_venda'])); ?></td>
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

<?php include __DIR__ . '/../layout/footer.php'; ?>