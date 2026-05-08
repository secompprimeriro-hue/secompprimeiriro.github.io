<?php
$page_title = 'Gerenciar Fornecedores';
$page_subtitle = 'Cadastre e gerencie todos os fornecedores';
$active_menu = 'fornecedores';
include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastrarFornecedorModal">
                <i class="fas fa-plus"></i> Novo Fornecedor
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> Lista de Fornecedores
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fornecedor</th>
                            <th>CNPJ</th>
                            <th>Representante</th>
                            <th>Região</th>
                            <th>Ramo</th>
                            <th>Contato</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($fornecedores as $fornecedor): ?>
                        <tr>
                            <td><strong><?php echo $fornecedor['nome']; ?></strong></td>
                            <td><?php echo $fornecedor['cnpj']; ?></td>
                            <td><?php echo $fornecedor['nome_representante']; ?></td>
                            <td><span class="badge bg-info"><?php echo $fornecedor['regiao_atuacao']; ?></span></td>
                            <td><?php echo $fornecedor['ramo_alimenticio']; ?></td>
                            <td>
                                <i class="fas fa-envelope"></i> <?php echo $fornecedor['email']; ?><br>
                                <i class="fas fa-phone"></i> <?php echo $fornecedor['telefone']; ?>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" onclick="verFornecedor(<?php echo $fornecedor['id']; ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cadastrar Fornecedor -->
<div class="modal fade" id="cadastrarFornecedorModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-truck"></i> Cadastrar Novo Fornecedor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="index.php?action=matriz_cadastrar_fornecedor" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nome do Fornecedor *</label>
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
                            <label class="form-label">Nome do Representante *</label>
                            <input type="text" class="form-control" name="representante" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Região de Atuação *</label>
                            <select class="form-select" name="regiao" required>
                                <option value="">Selecione...</option>
                                <option value="Centro-Sul">Centro-Sul</option>
                                <option value="Norte">Norte</option>
                                <option value="Sul">Sul</option>
                                <option value="Leste">Leste</option>
                                <option value="Oeste">Oeste</option>
                                <option value="Todas">Todas as Regiões</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ramo Alimentício *</label>
                            <select class="form-select" name="ramo" required>
                                <option value="">Selecione...</option>
                                <option value="Carnes">Carnes e Derivados</option>
                                <option value="Laticinios">Laticínios</option>
                                <option value="Graos">Grãos</option>
                                <option value="Vegetais">Vegetais</option>
                                <option value="Bebidas">Bebidas</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
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

<script>
function verFornecedor(id) {
    alert('Visualizar detalhes do fornecedor ' + id);
}
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>