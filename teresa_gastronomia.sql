-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 09/05/2026 às 01:22
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teresa_gastronomia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` int(11) NOT NULL,
  `filial_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT 0,
  `ultima_atualizacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`id`, `filial_id`, `produto_id`, `quantidade`, `ultima_atualizacao`) VALUES
(1, 1, 1, 100, '2026-05-08 19:36:58'),
(2, 1, 2, 80, '2026-05-08 19:36:58'),
(3, 1, 3, 50, '2026-05-08 19:36:58'),
(4, 1, 4, 60, '2026-05-08 19:36:58'),
(5, 1, 5, 70, '2026-05-08 19:36:58'),
(6, 1, 6, 90, '2026-05-08 19:36:58'),
(7, 2, 1, 85, '2026-05-08 19:36:58'),
(8, 2, 2, 70, '2026-05-08 19:36:58'),
(9, 2, 3, 35, '2026-05-08 19:36:58'),
(10, 2, 4, 45, '2026-05-08 19:36:58'),
(11, 2, 5, 55, '2026-05-08 19:36:58'),
(12, 2, 6, 75, '2026-05-08 19:36:58'),
(13, 3, 1, 90, '2026-05-08 19:36:58'),
(14, 3, 2, 75, '2026-05-08 19:36:58'),
(15, 3, 3, 40, '2026-05-08 19:36:58'),
(16, 3, 4, 50, '2026-05-08 19:36:58'),
(17, 3, 5, 60, '2026-05-08 19:36:58'),
(18, 3, 6, 80, '2026-05-08 19:36:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `filiais`
--

CREATE TABLE `filiais` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `nome_gestor` varchar(100) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `regiao` varchar(50) NOT NULL,
  `data_abertura` date DEFAULT NULL,
  `status` enum('ativa','inativa') DEFAULT 'ativa',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `filiais`
--

INSERT INTO `filiais` (`id`, `nome`, `email`, `telefone`, `cnpj`, `nome_gestor`, `localizacao`, `regiao`, `data_abertura`, `status`, `created_at`) VALUES
(1, 'Teresa Gastronomia - Matriz', 'matriz@teresa.com', '(88) 9999-9999', '12.345.678/0001-90', 'Teresa Silva', 'Rua São José, 100 - Juazeiro do Norte - CE', 'Centro-Sul', '2020-01-15', 'ativa', '2026-05-08 19:36:58'),
(2, 'Teresa Gastronomia - Crato', 'crato@teresa.com', '(88) 9888-8888', '12.345.678/0002-81', 'João Santos', 'Av. Padre Cícero, 500 - Crato - CE', 'Centro-Sul', '2021-03-20', 'ativa', '2026-05-08 19:36:58'),
(3, 'Teresa Gastronomia - Barbalha', 'barbalha@teresa.com', '(88) 9777-7777', '12.345.678/0003-72', 'Maria Oliveira', 'Praça da Matriz, 200 - Barbalha - CE', 'Centro-Sul', '2022-06-10', 'ativa', '2026-05-08 19:36:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `nome_representante` varchar(100) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `ramo_alimenticio` varchar(100) NOT NULL,
  `regiao_atuacao` varchar(50) NOT NULL,
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `nome`, `email`, `telefone`, `cnpj`, `nome_representante`, `localizacao`, `ramo_alimenticio`, `regiao_atuacao`, `status`, `created_at`) VALUES
(1, 'Distribuidora Nordestina', 'contato@nordestina.com', '(88) 9999-8888', '23.456.789/0001-11', 'Carlos Eduardo', 'Juazeiro do Norte - CE', 'Carnes e Derivados', 'Centro-Sul', 'ativo', '2026-05-08 19:36:58'),
(2, 'Laticínios Serra Verde', 'vendas@serraverde.com', '(88) 9777-6666', '34.567.890/0001-22', 'Ana Paula Souza', 'Crato - CE', 'Laticínios', 'Centro-Sul', 'ativo', '2026-05-08 19:36:58'),
(3, 'Grãos do Sertão', 'contato@graosertao.com', '(88) 9666-5555', '45.678.901/0001-33', 'Roberto Lima', 'Barbalha - CE', 'Grãos', 'Centro-Sul', 'ativo', '2026-05-08 19:36:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `filial_id` int(11) DEFAULT NULL,
  `fornecedor_id` int(11) DEFAULT NULL,
  `data_pedido` datetime DEFAULT current_timestamp(),
  `status` enum('pendente','aprovado','enviado','entregue','cancelado') DEFAULT 'pendente',
  `valor_total` decimal(10,2) DEFAULT NULL,
  `observacao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido_itens`
--

CREATE TABLE `pedido_itens` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `unidade_medida` varchar(20) NOT NULL,
  `preco_compra` decimal(10,2) DEFAULT NULL,
  `preco_venda` decimal(10,2) NOT NULL,
  `estoque_minimo` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `categoria`, `unidade_medida`, `preco_compra`, `preco_venda`, `estoque_minimo`) VALUES
(1, 'Arroz', 'Grãos', 'kg', 3.50, 5.00, 20),
(2, 'Feijão', 'Grãos', 'kg', 5.00, 7.00, 15),
(3, 'Carne de Sol', 'Carnes', 'kg', 35.00, 45.00, 10),
(4, 'Queijo Coalho', 'Laticínios', 'kg', 25.00, 32.00, 10),
(5, 'Macaxeira', 'Vegetais', 'kg', 2.50, 4.00, 15),
(6, 'Leite', 'Bebidas', 'litro', 3.00, 4.50, 20),
(7, 'Creme de Leite', 'Laticínios', 'lata', 4.00, 6.00, 15),
(8, 'Manteiga', 'Laticínios', 'kg', 28.00, 38.00, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('matriz','gerente') NOT NULL,
  `filial_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `filial_id`, `created_at`) VALUES
(1, 'Administrador Matriz', 'admin@teresa.com', '0192023a7bbd73250516f069df18b500', 'matriz', NULL, '2026-05-08 19:36:58'),
(2, 'João Santos', 'crato@teresa.com', 'a3725e9cf9c04c2eab91088ccf605159', 'gerente', NULL, '2026-05-08 19:36:58'),
(3, 'Maria Oliveira', 'barbalha@teresa.com', 'a3725e9cf9c04c2eab91088ccf605159', 'gerente', NULL, '2026-05-08 19:36:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `filial_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_venda` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `filial_id`, `produto_id`, `quantidade`, `valor_unitario`, `valor_total`, `data_venda`) VALUES
(1, NULL, 1, 25, 5.00, 125.00, '2026-05-08 22:11:20'),
(2, NULL, 4, 3, 32.00, 96.00, '2026-05-09 00:12:41');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_filial_produto` (`filial_id`,`produto_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `filiais`
--
ALTER TABLE `filiais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filial_id` (`filial_id`),
  ADD KEY `fornecedor_id` (`fornecedor_id`);

--
-- Índices de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filial_id` (`filial_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `filiais`
--
ALTER TABLE `filiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`filial_id`) REFERENCES `filiais` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `estoque_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`filial_id`) REFERENCES `filiais` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD CONSTRAINT `pedido_itens_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedido_itens_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`filial_id`) REFERENCES `filiais` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendas_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
