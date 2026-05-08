<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/AuthController.php';

class FilialController {
    private $auth;
    private $db;
    
    public function __construct() {
        $this->auth = new AuthController();
        $this->auth->verificarPermissao('gerente');
        $this->db = DB::getInstance();
    }
    
    public function dashboard() {
        $filial_id = $_SESSION['filial_id'];
        
        // Estatísticas da filial
        $vendasMes = $this->db->fetchOne("
            SELECT SUM(valor_total) as total, COUNT(*) as quantidade 
            FROM vendas 
            WHERE filial_id = ? AND MONTH(data_venda) = MONTH(CURRENT_DATE())
        ", [$filial_id]);
        
        // Produtos mais vendidos
        $topProdutos = $this->db->fetchAll("
            SELECT p.nome, SUM(v.quantidade) as quantidade, SUM(v.valor_total) as receita
            FROM produtos p
            JOIN vendas v ON p.id = v.produto_id
            WHERE v.filial_id = ?
            GROUP BY p.id
            ORDER BY quantidade DESC
            LIMIT 5
        ", [$filial_id]);
        
        // Estoque atual
        $estoque = $this->db->fetchAll("
            SELECT p.nome, e.quantidade, p.estoque_minimo, p.unidade_medida
            FROM estoque e
            JOIN produtos p ON e.produto_id = p.id
            WHERE e.filial_id = ?
            ORDER BY e.quantidade ASC
        ", [$filial_id]);
        
        // Vendas por dia (últimos 7 dias)
        $vendasPorDia = $this->db->fetchAll("
            SELECT DATE(data_venda) as data, SUM(valor_total) as total
            FROM vendas
            WHERE filial_id = ? AND data_venda >= DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY)
            GROUP BY DATE(data_venda)
            ORDER BY data
        ", [$filial_id]);
        
        include __DIR__ . '/../views/filial/dashboard.php';
    }
    
    public function vendas() {
        $filial_id = $_SESSION['filial_id'];
        
        // Listar produtos para venda
        $produtos = $this->db->fetchAll("SELECT * FROM produtos ORDER BY nome");
        
        // Vendas realizadas
        $vendas = $this->db->fetchAll("
            SELECT v.*, p.nome as produto
            FROM vendas v
            JOIN produtos p ON v.produto_id = p.id
            WHERE v.filial_id = ?
            ORDER BY v.data_venda DESC
            LIMIT 50
        ", [$filial_id]);
        
        include __DIR__ . '/../views/filial/vendas.php';
    }
    
    public function registrarVenda() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $filial_id = $_SESSION['filial_id'];
            $produto_id = $_POST['produto_id'];
            $quantidade = $_POST['quantidade'];
            
            // Buscar produto
            $produto = $this->db->fetchOne("SELECT * FROM produtos WHERE id = ?", [$produto_id]);
            
            if($produto) {
                $valor_total = $produto['preco_venda'] * $quantidade;
                
                // Registrar venda
                $this->db->insert('vendas', [
                    'filial_id' => $filial_id,
                    'produto_id' => $produto_id,
                    'quantidade' => $quantidade,
                    'valor_unitario' => $produto['preco_venda'],
                    'valor_total' => $valor_total,
                    'data_venda' => date('Y-m-d H:i:s')
                ]);
                
                // Atualizar estoque
                $this->db->query("
                    UPDATE estoque 
                    SET quantidade = quantidade - ?, ultima_atualizacao = NOW()
                    WHERE filial_id = ? AND produto_id = ?
                ", [$quantidade, $filial_id, $produto_id]);
                
                $_SESSION['mensagem'] = "Venda registrada com sucesso!";
            }
            
            header("Location: index.php?action=filial_vendas");
            exit();
        }
    }
    
    public function fornecedores() {
        $filial = $this->db->fetchOne("SELECT regiao FROM filiais WHERE id = ?", [$_SESSION['filial_id']]);
        $regiao = $filial ? $filial['regiao'] : '';
        
        // Buscar fornecedores da região
        $fornecedores = $this->db->fetchAll("
            SELECT * FROM fornecedores 
            WHERE regiao_atuacao = ? OR regiao_atuacao = 'Todas'
            AND status = 'ativo'
            ORDER BY nome
        ", [$regiao]);
        
        include __DIR__ . '/../views/filial/fornecedores.php';
    }
    
    public function pedidos() {
        $filial_id = $_SESSION['filial_id'];
        
        $pedidos = $this->db->fetchAll("
            SELECT p.*, f.nome as fornecedor
            FROM pedidos p
            JOIN fornecedores f ON p.fornecedor_id = f.id
            WHERE p.filial_id = ?
            ORDER BY p.data_pedido DESC
        ", [$filial_id]);
        
        include __DIR__ . '/../views/filial/pedidos.php';
    }
    
    public function criarPedido() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $filial_id = $_SESSION['filial_id'];
            $fornecedor_id = $_POST['fornecedor_id'];
            $observacao = $_POST['observacao'];
            
            $pedido_id = $this->db->insert('pedidos', [
                'filial_id' => $filial_id,
                'fornecedor_id' => $fornecedor_id,
                'observacao' => $observacao,
                'status' => 'pendente'
            ]);
            
            $_SESSION['mensagem'] = "Pedido criado com sucesso!";
            header("Location: index.php?action=filial_pedidos");
            exit();
        }
    }
    
    public function estoque() {
        $filial_id = $_SESSION['filial_id'];
        
        $estoque = $this->db->fetchAll("
            SELECT p.nome, p.categoria, p.unidade_medida, e.quantidade, p.estoque_minimo,
                   CASE 
                       WHEN e.quantidade <= p.estoque_minimo THEN 'crítico'
                       WHEN e.quantidade <= p.estoque_minimo * 2 THEN 'baixo'
                       ELSE 'normal'
                   END as status
            FROM estoque e
            JOIN produtos p ON e.produto_id = p.id
            WHERE e.filial_id = ?
            ORDER BY e.quantidade ASC
        ", [$filial_id]);
        
        include __DIR__ . '/../views/filial/estoque.php';
    }
}
?>