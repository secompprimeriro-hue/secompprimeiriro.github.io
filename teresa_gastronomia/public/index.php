<?php
session_start();

// Autoload
spl_autoload_register(function ($class) {
    $prefix = '';
    $base_dir = __DIR__ . '/../app/controllers/';
    
    $file = $base_dir . $class . '.php';
    if (file_exists($file)) {
        require $file;
        return;
    }
    
    $base_dir = __DIR__ . '/../app/models/';
    $file = $base_dir . $class . '.php';
    if (file_exists($file)) {
        require $file;
        return;
    }
});

// Rotas
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch($action) {
    case 'login':
        $auth = new AuthController();
        $auth->login();
        break;
        
    case 'logout':
        $auth = new AuthController();
        $auth->logout();
        break;
        
    // Rotas da Matriz
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
        
    default:
        $auth = new AuthController();
        $auth->login();
        break;
}
?>