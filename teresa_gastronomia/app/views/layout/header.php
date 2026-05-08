<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Grupo Tereza Gastronomia'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        <?php echo file_get_contents(__DIR__ . '/../../../public/assets/css/style.css'); ?>
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-utensils"></i>
            <h3>Grupo Tereza</h3>
        </div>
        <div class="sidebar-menu">
            <?php if($_SESSION['usuario_tipo'] == 'matriz'): ?>
                <a href="index.php?action=matriz_dashboard" class="<?php echo ($active_menu ?? '') == 'dashboard' ? 'active' : ''; ?>">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
                <a href="index.php?action=matriz_filiais" class="<?php echo ($active_menu ?? '') == 'filiais' ? 'active' : ''; ?>">
                    <i class="fas fa-store"></i> Filiais
                </a>
                <a href="index.php?action=matriz_fornecedores" class="<?php echo ($active_menu ?? '') == 'fornecedores' ? 'active' : ''; ?>">
                    <i class="fas fa-truck"></i> Fornecedores
                </a>
                <a href="index.php?action=matriz_vendas">
                    <i class="fas fa-chart-simple"></i> Vendas
                </a>
                <a href="index.php?action=matriz_relatorios" class="<?php echo ($active_menu ?? '') == 'relatorios' ? 'active' : ''; ?>">
                    <i class="fas fa-file-alt"></i> Relatórios
                </a>
                <a href="index.php?action=matriz_analise_consumo" class="<?php echo ($active_menu ?? '') == 'analise' ? 'active' : ''; ?>">
                    <i class="fas fa-chart-pie"></i> Análise
                </a>
                <a href="index.php?action=matriz_ranking" class="<?php echo ($active_menu ?? '') == 'ranking' ? 'active' : ''; ?>">
                    <i class="fas fa-trophy"></i> Ranking
                </a>
            <?php else: ?>
                <a href="index.php?action=filial_dashboard" class="<?php echo ($active_menu ?? '') == 'dashboard' ? 'active' : ''; ?>">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
                <a href="index.php?action=filial_vendas">
                    <i class="fas fa-cash-register"></i> Vendas
                </a>
                <a href="index.php?action=filial_fornecedores">
                    <i class="fas fa-truck"></i> Fornecedores
                </a>
                <a href="index.php?action=filial_pedidos">
                    <i class="fas fa-shopping-cart"></i> Pedidos
                </a>
                <a href="index.php?action=filial_estoque">
                    <i class="fas fa-boxes"></i> Estoque
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h2><?php echo $page_title ?? 'Dashboard'; ?></h2>
                <p><?php echo $page_subtitle ?? ''; ?></p>
            </div>
            <div class="user-info">
                <span class="user-badge">
                    <i class="fas fa-user"></i> <?php echo $_SESSION['usuario_nome']; ?>
                </span>
                <a href="index.php?action=logout" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>