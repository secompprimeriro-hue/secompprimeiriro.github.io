<?php
$page_title = 'Gerenciar Filiais';
$page_subtitle = 'Cadastre e gerencie todas as filiais';
$active_menu = 'filiais';
include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastrarFilialModal">
                <i class="fas fa-plus"></i> Nova Filial
            </button>
        </div>
    </div>

    <div class="row">
        <?php foreach($filiais as $filial): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div><i class="fas fa-store" style="font-size: 40px; color: #2d6a4f;"></i></div>
                        <span class="badge bg-success">Ativa</span>
                    </div>
                    <h5><?php echo $filial['nome']; ?></h5>
                    <p class="small text-muted">
                        <i class="fas fa-map-marker-alt"></i> <?php echo $filial['localizacao']; ?><br>
                        <i class="fas fa-user"></i> Gestor: <?php echo $filial['nome_gestor']; ?><br>
                        <i class="fas fa-envelope"></i> <?php echo $filial['email']; ?><br>
                        <i class="fas fa-chart-line"></i> Vendas mês: R$ <?php echo number_format($filial['vendas_mes'] ?? 0, 2); ?>
                    </p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal Cadastrar Filial -->
<div class="modal fade" id="cadastrarFilialModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-circle"></i> Cadastrar Nova Filial</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="index.php?action=matriz_cadastrar_filial" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nome da Filial *</label>
                            <input type="text" class="form-control" name="nome" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">CNPJ *</label>
                            <input type="text" class="form-control" name="cnpj" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">E-mail *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefone *</label>
                            <input type="text" class="form-control" name="telefone" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nome do Gestor *</label>
                            <input type="text" class="form-control" name="nome_gestor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Região *</label>
                            <select class="form-select" name="regiao" required>
                                <option value="">Selecione</option>
                                <option value="Centro-Sul">Centro-Sul</option>
                                <option value="Norte">Norte</option>
                                <option value="Sul">Sul</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Localização *</label>
                            <input type="text" class="form-control" name="localizacao" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>