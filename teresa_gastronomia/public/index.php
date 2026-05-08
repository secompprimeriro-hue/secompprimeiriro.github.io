<?php
session_start();

// Autoload
spl_autoload_register(function ($class) {
    $base_dirs = [
        __DIR__ . '/../app/controllers/',
        __DIR__ . '/../app/models/'
    ];
    
    foreach ($base_dirs as $base_dir) {
        $file = $base_dir . $class . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});

// Rotas
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch($action) {
    // Autenticação
    case 'login':
        $auth = new AuthController();
        $auth->login();
        break;
        
    case 'logout':
        $auth = new AuthController();
        $auth->logout();
        break;
        
    // ========== ROTAS DA MATRIZ ==========
    case 'matriz_dashboard':
        $controller = new MatrizController();
        $controller->dashboard();
        break;
        
    case 'matriz_filiais':
        $controller = new MatrizController();
        $controller->filiais();
        break;
        
    case 'matriz_cadastrar_filial':
        $controller = new MatrizController();
        $controller->cadastrarFilial();
        break;
        
    case 'matriz_fornecedores':
        $controller = new MatrizController();
        $controller->fornecedores();
        break;
        
    case 'matriz_cadastrar_fornecedor':
        $controller = new MatrizController();
        $controller->cadastrarFornecedor();
        break;
        
    case 'matriz_vendas':
        $controller = new MatrizController();
        $controller->vendas();
        break;
        
    case 'matriz_relatorios':
        $controller = new MatrizController();
        $controller->relatorios();
        break;
        
    case 'matriz_analise_consumo':
        $controller = new MatrizController();
        $controller->analiseConsumo();
        break;
        
    case 'matriz_ranking':
        $controller = new MatrizController();
        $controller->rankingFiliais();
        break;
        
    // ========== ROTAS DA FILIAL ==========
    case 'filial_dashboard':
        $controller = new FilialController();
        $controller->dashboard();
        break;
        
    case 'filial_vendas':
        $controller = new FilialController();
        $controller->vendas();
        break;
        
    case 'filial_registrar_venda':
        $controller = new FilialController();
        $controller->registrarVenda();
        break;
        
    case 'filial_fornecedores':
        $controller = new FilialController();
        $controller->fornecedores();
        break;
        
    case 'filial_pedidos':
        $controller = new FilialController();
        $controller->pedidos();
        break;
        
    case 'filial_criar_pedido':
        $controller = new FilialController();
        $controller->criarPedido();
        break;
        
    case 'filial_estoque':
        $controller = new FilialController();
        $controller->estoque();
        break;
        
    case 'filial_relatorios':
        $controller = new FilialController();
        $controller->relatorios();
        break;
        
    // Rota padrão
    default:
        $auth = new AuthController();
        $auth->login();
        break;
}
?>