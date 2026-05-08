<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/AuthController.php';

class MatrizController {
    private $auth;
    private $db;
    
    public function __construct() {
        $this->auth = new AuthController();
        $this->auth->verificarPermissao('matriz');
        $this->db = DB::getInstance();
    }
    
    public function dashboard() {
        // Estatísticas
        $totalFiliais = $this->db->fetchOne("SELECT COUNT(*) as total FROM filiais WHERE status = 'ativa'");
        $totalFornecedores = $this->db->fetchOne("SELECT COUNT(*) as total FROM fornecedores WHERE status = 'ativo'");
        
        // Vendas do mês
        $vendasMes = $this->db->fetchOne("SELECT COALESCE(SUM(valor_total), 0) as total FROM vendas WHERE MONTH(data_venda) = MONTH(CURRENT_DATE()) AND YEAR(data_venda) = YEAR(CURRENT_DATE())");
        
        // Vendas por filial
        $vendasPorFilial = $this->db->fetchAll("
            SELECT f.nome, COALESCE(SUM(v.valor_total), 0) as total 
            FROM filiais f 
            LEFT JOIN vendas v ON f.id = v.filial_id AND MONTH(v.data_venda) = MONTH(CURRENT_DATE()) AND YEAR(v.data_venda) = YEAR(CURRENT_DATE())
            GROUP BY f.id
        ");
        
        // Produtos mais vendidos (com verificação)
        $topProdutos = $this->db->fetchAll("
            SELECT p.nome, COALESCE(SUM(v.quantidade), 0) as quantidade, COALESCE(SUM(v.valor_total), 0) as receita
            FROM produtos p
            LEFT JOIN vendas v ON p.id = v.produto_id AND MONTH(v.data_venda) = MONTH(CURRENT_DATE()) AND YEAR(v.data_venda) = YEAR(CURRENT_DATE())
            GROUP BY p.id
            ORDER BY quantidade DESC
            LIMIT 5
        ");
        
        // Alertas de estoque baixo
        $alertasEstoque = $this->db->fetchAll("
            SELECT f.nome as filial, p.nome as produto, e.quantidade, p.estoque_minimo
            FROM estoque e
            JOIN filiais f ON e.filial_id = f.id
            JOIN produtos p ON e.produto_id = p.id
            WHERE e.quantidade <= p.estoque_minimo
            LIMIT 10
        ");
        
        // Vendas por dia (últimos 30 dias)
        $vendasPorDia = $this->db->fetchAll("
            SELECT DATE(data_venda) as data, COALESCE(SUM(valor_total), 0) as total
            FROM vendas
            WHERE data_venda >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)
            GROUP BY DATE(data_venda)
            ORDER BY data
        ");
        
        // Padrões de consumo por região
        $padroesConsumo = $this->db->fetchAll("
            SELECT f.regiao, p.nome as produto, COALESCE(SUM(v.quantidade), 0) as total_vendido
            FROM vendas v
            JOIN filiais f ON v.filial_id = f.id
            JOIN produtos p ON v.produto_id = p.id
            WHERE v.data_venda >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)
            GROUP BY f.regiao, p.id
            ORDER BY f.regiao, total_vendido DESC
        ");
        
        // Agrupar padrões por região (apenas o mais vendido)
        $padroesAgrupados = [];
        foreach($padroesConsumo as $padrao) {
            if(!isset($padroesAgrupados[$padrao['regiao']])) {
                $padroesAgrupados[$padrao['regiao']] = $padrao;
            }
        }
        
        include __DIR__ . '/../views/matriz/dashboard.php';
    }
    
    public function filiais() {
        $filiais = $this->db->fetchAll("SELECT * FROM filiais ORDER BY nome");
        
        foreach($filiais as &$filial) {
            $vendas = $this->db->fetchOne("
                SELECT COALESCE(SUM(valor_total), 0) as total_vendas, COUNT(*) as total_pedidos
                FROM vendas 
                WHERE filial_id = ? AND MONTH(data_venda) = MONTH(CURRENT_DATE()) AND YEAR(data_venda) = YEAR(CURRENT_DATE())
            ", [$filial['id']]);
            $filial['vendas_mes'] = $vendas['total_vendas'] ?? 0;
            $filial['pedidos_mes'] = $vendas['total_pedidos'] ?? 0;
        }
        
        include __DIR__ . '/../views/matriz/filiais.php';
    }
    
    public function cadastrarFilial() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'telefone' => $_POST['telefone'],
                'cnpj' => $_POST['cnpj'],
                'nome_gestor' => $_POST['nome_gestor'],
                'localizacao' => $_POST['localizacao'],
                'regiao' => $_POST['regiao'],
                'data_abertura' => date('Y-m-d'),
                'status' => 'ativa'
            ];
            
            $filialId = $this->db->insert('filiais', $data);
            
            $senhaPadrao = md5('filial123');
            $this->db->insert('usuarios', [
                'nome' => $_POST['nome_gestor'],
                'email' => $_POST['email'],
                'senha' => $senhaPadrao,
                'tipo' => 'gerente',
                'filial_id' => $filialId
            ]);
            
            $produtos = $this->db->fetchAll("SELECT id FROM produtos");
            foreach($produtos as $produto) {
                $this->db->insert('estoque', [
                    'filial_id' => $filialId,
                    'produto_id' => $produto['id'],
                    'quantidade' => 50
                ]);
            }
            
            $_SESSION['mensagem'] = "Filial cadastrada com sucesso!";
            header("Location: index.php?action=matriz_filiais");
            exit();
        }
    }
    
    public function fornecedores() {
        $fornecedores = $this->db->fetchAll("SELECT * FROM fornecedores WHERE status = 'ativo' ORDER BY nome");
        include __DIR__ . '/../views/matriz/fornecedores.php';
    }
    
    public function cadastrarFornecedor() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'telefone' => $_POST['telefone'],
                'cnpj' => $_POST['cnpj'],
                'nome_representante' => $_POST['representante'],
                'localizacao' => $_POST['localizacao'],
                'ramo_alimenticio' => $_POST['ramo'],
                'regiao_atuacao' => $_POST['regiao'],
                'status' => 'ativo'
            ];
            
            $this->db->insert('fornecedores', $data);
            $_SESSION['mensagem'] = "Fornecedor cadastrado com sucesso!";
            header("Location: index.php?action=matriz_fornecedores");
            exit();
        }
    }
    
    public function vendas() {
        $vendas = $this->db->fetchAll("
            SELECT v.*, f.nome as filial, p.nome as produto 
            FROM vendas v
            JOIN filiais f ON v.filial_id = f.id
            JOIN produtos p ON v.produto_id = p.id
            ORDER BY v.data_venda DESC
            LIMIT 100
        ");
        
        $vendasPorDia = $this->db->fetchAll("
            SELECT DATE(data_venda) as data, COALESCE(SUM(valor_total), 0) as total
            FROM vendas
            WHERE data_venda >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)
            GROUP BY DATE(data_venda)
            ORDER BY data
        ");
        
        $resumoVendas = $this->db->fetchOne("
            SELECT 
                COALESCE(SUM(valor_total), 0) as total_geral,
                COUNT(*) as total_vendas,
                COALESCE(AVG(valor_total), 0) as ticket_medio
            FROM vendas
            WHERE MONTH(data_venda) = MONTH(CURRENT_DATE()) AND YEAR(data_venda) = YEAR(CURRENT_DATE())
        ");
        
        include __DIR__ . '/../views/matriz/vendas.php';
    }
    
    public function rankingFiliais() {
        $rankingFiliais = $this->db->fetchAll("
            SELECT 
                f.nome,
                COALESCE(SUM(v.valor_total), 0) as vendas,
                COUNT(v.id) as quantidade_vendas,
                COALESCE(AVG(v.valor_total), 0) as ticket_medio
            FROM filiais f
            LEFT JOIN vendas v ON f.id = v.filial_id AND MONTH(v.data_venda) = MONTH(CURRENT_DATE()) AND YEAR(v.data_venda) = YEAR(CURRENT_DATE())
            GROUP BY f.id
            ORDER BY vendas DESC
        ");
        
        include __DIR__ . '/../views/matriz/ranking_filiais.php';
    }
    
    public function relatorios() {
        $vendasPorFilial = $this->db->fetchAll("
            SELECT f.nome, 
                   COALESCE(SUM(v.valor_total), 0) as total_vendas,
                   COUNT(v.id) as quantidade_vendas,
                   COALESCE(AVG(v.valor_total), 0) as ticket_medio
            FROM filiais f
            LEFT JOIN vendas v ON f.id = v.filial_id AND MONTH(v.data_venda) = MONTH(CURRENT_DATE()) AND YEAR(v.data_venda) = YEAR(CURRENT_DATE())
            GROUP BY f.id
        ");
        
        $produtosMaisVendidos = $this->db->fetchAll("
            SELECT p.nome, p.categoria, COALESCE(SUM(v.quantidade), 0) as total_vendido, COALESCE(SUM(v.valor_total), 0) as receita
            FROM produtos p
            LEFT JOIN vendas v ON p.id = v.produto_id
            GROUP BY p.id
            ORDER BY total_vendido DESC
            LIMIT 10
        ");
        
        include __DIR__ . '/../views/matriz/relatorios.php';
    }
    
    public function analiseConsumo() {
        $analise = $this->db->fetchAll("
            SELECT 
                f.nome as filial,
                f.regiao,
                p.nome as produto,
                COALESCE(SUM(v.quantidade), 0) as quantidade_vendida,
                COALESCE(SUM(v.valor_total), 0) as receita
            FROM vendas v
            JOIN filiais f ON v.filial_id = f.id
            JOIN produtos p ON v.produto_id = p.id
            WHERE v.data_venda >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)
            GROUP BY f.id, p.id
            ORDER BY f.nome, quantidade_vendida DESC
        ");
        
        include __DIR__ . '/../views/matriz/analise_consumo.php';
    }
}
?>