-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS teresa_gastronomia;
USE teresa_gastronomia;

-- Tabela de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('matriz', 'gerente') NOT NULL,
    filial_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de filiais
CREATE TABLE IF NOT EXISTS filiais (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    cnpj VARCHAR(18) UNIQUE NOT NULL,
    nome_gestor VARCHAR(100) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    regiao VARCHAR(50) NOT NULL,
    data_abertura DATE,
    status ENUM('ativa', 'inativa') DEFAULT 'ativa',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de fornecedores
CREATE TABLE IF NOT EXISTS fornecedores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    cnpj VARCHAR(18) UNIQUE NOT NULL,
    nome_representante VARCHAR(100) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    ramo_alimenticio VARCHAR(100) NOT NULL,
    regiao_atuacao VARCHAR(50) NOT NULL,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    unidade_medida VARCHAR(20) NOT NULL,
    preco_compra DECIMAL(10,2),
    preco_venda DECIMAL(10,2) NOT NULL,
    estoque_minimo INT DEFAULT 10
);

-- Tabela de estoque
CREATE TABLE IF NOT EXISTS estoque (
    id INT PRIMARY KEY AUTO_INCREMENT,
    filial_id INT,
    produto_id INT,
    quantidade INT DEFAULT 0,
    ultima_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (filial_id) REFERENCES filiais(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
    UNIQUE KEY uk_filial_produto (filial_id, produto_id)
);

-- Tabela de vendas
CREATE TABLE IF NOT EXISTS vendas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    filial_id INT,
    produto_id INT,
    quantidade INT NOT NULL,
    valor_unitario DECIMAL(10,2) NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_venda DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (filial_id) REFERENCES filiais(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Tabela de pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    filial_id INT,
    fornecedor_id INT,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pendente', 'aprovado', 'enviado', 'entregue', 'cancelado') DEFAULT 'pendente',
    valor_total DECIMAL(10,2),
    observacao TEXT,
    FOREIGN KEY (filial_id) REFERENCES filiais(id) ON DELETE CASCADE,
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id) ON DELETE CASCADE
);

-- Tabela de itens do pedido
CREATE TABLE IF NOT EXISTS pedido_itens (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pedido_id INT,
    produto_id INT,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Inserir dados iniciais
INSERT INTO usuarios (nome, email, senha, tipo) VALUES 
('Administrador Matriz', 'admin@teresa.com', MD5('admin123'), 'matriz'),
('João Santos', 'crato@teresa.com', MD5('filial123'), 'gerente'),
('Maria Oliveira', 'barbalha@teresa.com', MD5('filial123'), 'gerente');

INSERT INTO filiais (nome, email, telefone, cnpj, nome_gestor, localizacao, regiao, data_abertura) VALUES
('Teresa Gastronomia - Matriz', 'matriz@teresa.com', '(88) 9999-9999', '12.345.678/0001-90', 'Teresa Silva', 'Rua São José, 100 - Juazeiro do Norte - CE', 'Centro-Sul', '2020-01-15'),
('Teresa Gastronomia - Crato', 'crato@teresa.com', '(88) 9888-8888', '12.345.678/0002-81', 'João Santos', 'Av. Padre Cícero, 500 - Crato - CE', 'Centro-Sul', '2021-03-20'),
('Teresa Gastronomia - Barbalha', 'barbalha@teresa.com', '(88) 9777-7777', '12.345.678/0003-72', 'Maria Oliveira', 'Praça da Matriz, 200 - Barbalha - CE', 'Centro-Sul', '2022-06-10');

INSERT INTO fornecedores (nome, email, telefone, cnpj, nome_representante, localizacao, ramo_alimenticio, regiao_atuacao) VALUES
('Distribuidora Nordestina', 'contato@nordestina.com', '(88) 9999-8888', '23.456.789/0001-11', 'Carlos Eduardo', 'Juazeiro do Norte - CE', 'Carnes e Derivados', 'Centro-Sul'),
('Laticínios Serra Verde', 'vendas@serraverde.com', '(88) 9777-6666', '34.567.890/0001-22', 'Ana Paula Souza', 'Crato - CE', 'Laticínios', 'Centro-Sul'),
('Grãos do Sertão', 'contato@graosertao.com', '(88) 9666-5555', '45.678.901/0001-33', 'Roberto Lima', 'Barbalha - CE', 'Grãos', 'Centro-Sul');

INSERT INTO produtos (nome, categoria, unidade_medida, preco_compra, preco_venda, estoque_minimo) VALUES
('Arroz', 'Grãos', 'kg', 3.50, 5.00, 20),
('Feijão', 'Grãos', 'kg', 5.00, 7.00, 15),
('Carne de Sol', 'Carnes', 'kg', 35.00, 45.00, 10),
('Queijo Coalho', 'Laticínios', 'kg', 25.00, 32.00, 10),
('Macaxeira', 'Vegetais', 'kg', 2.50, 4.00, 15),
('Leite', 'Bebidas', 'litro', 3.00, 4.50, 20),
('Creme de Leite', 'Laticínios', 'lata', 4.00, 6.00, 15),
('Manteiga', 'Laticínios', 'kg', 28.00, 38.00, 8);

-- Inserir estoque inicial
INSERT INTO estoque (filial_id, produto_id, quantidade) VALUES
(1, 1, 100), (1, 2, 80), (1, 3, 50), (1, 4, 60), (1, 5, 70), (1, 6, 90),
(2, 1, 85), (2, 2, 70), (2, 3, 35), (2, 4, 45), (2, 5, 55), (2, 6, 75),
(3, 1, 90), (3, 2, 75), (3, 3, 40), (3, 4, 50), (3, 5, 60), (3, 6, 80);