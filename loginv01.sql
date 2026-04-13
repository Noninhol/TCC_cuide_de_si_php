-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/04/2026 às 00:30
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
-- Banco de dados: `loginv01`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `idcar` bigint(100) NOT NULL,
  `Codei` bigint(100) DEFAULT NULL,
  `cpf` bigint(11) DEFAULT NULL,
  `finalizar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`idcar`, `Codei`, `cpf`, `finalizar`) VALUES
(50, 37, 13, '2025-05-29 10:35:13'),
(52, 35, 13, '2025-05-29 11:15:26'),
(54, 35, 13, '2025-05-29 11:30:50'),
(58, 34, 451695314, '2025-05-30 11:50:46'),
(62, 37, 451695314, '2025-05-30 21:13:46'),
(65, 34, 7894562301, '0000-00-00 00:00:00'),
(68, 38, 77777777777, '2025-06-02 09:48:31'),
(71, 37, 5866613092, '2025-06-02 10:04:15'),
(75, 37, 101010, '2025-06-10 02:39:24'),
(77, 38, 101010, '0000-00-00 00:00:00'),
(78, 38, 101010, '2025-06-10 02:45:49'),
(81, 38, 7894562301, '0000-00-00 00:00:00'),
(84, 35, 789, '2025-06-10 19:31:32'),
(85, 35, 78945612, '2025-06-10 20:26:38'),
(86, 35, 78945612, '2025-06-10 20:36:10'),
(87, 37, 8564, '2025-06-28 16:05:17'),
(88, 35, 8564, '2025-06-28 16:14:41'),
(89, 34, 8564, '2025-06-28 16:09:17'),
(90, 37, 8564, '0000-00-00 00:00:00'),
(91, 35, 8564, '0000-00-00 00:00:00'),
(92, 35, 8564, '0000-00-00 00:00:00'),
(93, 35, 8564, '2025-06-29 22:40:34'),
(95, 34, 8564, '0000-00-00 00:00:00'),
(96, 34, 78, '2025-07-01 20:51:47'),
(102, 39, 78, '2025-07-01 23:50:29'),
(104, 35, 78, '2025-07-01 23:45:16'),
(105, 34, 78, '2025-07-01 23:54:57'),
(106, 35, 78, '2025-07-01 23:53:33'),
(107, 35, 78, '2025-07-01 23:53:27'),
(108, 35, 78, '2025-07-01 23:54:53'),
(109, 35, 78, '2025-07-01 23:56:42'),
(110, 34, 78, '2025-07-02 00:03:58'),
(111, 35, 78, '2025-07-02 00:00:18'),
(112, 37, 78, '2025-07-02 00:00:16'),
(113, 37, 12, '2025-07-02 19:07:13'),
(114, 37, 12, '0000-00-00 00:00:00'),
(115, 35, 12, '2025-07-02 19:09:15'),
(117, 35, 1111111, '2025-07-02 21:11:13'),
(118, 35, 6362425014, '2025-07-03 19:09:20'),
(119, 39, 6362425014, '2025-07-03 19:30:02'),
(120, 35, 6362425014, '2025-07-03 19:38:34'),
(121, 34, 6362425014, '0000-00-00 00:00:00'),
(122, 37, 8288526, '2025-07-03 19:48:04'),
(124, 37, 145797639, '0000-00-00 00:00:00'),
(125, 39, 145797639, '2025-07-03 20:45:52'),
(126, 35, 60000917028, '2025-07-03 20:57:22'),
(127, 35, 60000917028, '2025-07-03 21:05:00'),
(128, 35, 60000917028, '2025-07-03 21:17:50'),
(129, 35, 60000917028, '0000-00-00 00:00:00'),
(130, 34, 60000917028, '0000-00-00 00:00:00'),
(131, 39, 60000917028, '0000-00-00 00:00:00'),
(132, 40, 60000917028, '0000-00-00 00:00:00'),
(133, 41, 60000917028, '0000-00-00 00:00:00'),
(134, 42, 60000917028, '0000-00-00 00:00:00'),
(135, 34, 14, '0000-00-00 00:00:00'),
(136, 39, 14, '0000-00-00 00:00:00'),
(137, 41, 14, '2025-07-11 01:17:16'),
(138, 39, 17, '2025-07-11 01:20:46'),
(139, 39, 55, '2025-07-11 02:52:03'),
(140, 60, 123, '2025-09-27 15:12:19');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `cpf` bigint(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `idV` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`cpf`, `nome`, `email`, `senha`, `idV`) VALUES
(0, 'oo', 'oo', '00', 4),
(12, 'ee', 'danoninho.danoni@gmail.com', '11', 25),
(13, 'enzo', 'enzogameplay@gmail.com', 'enzo10123', 25),
(14, 'Henry', 'henry', '123', 42),
(17, 'DanDan', 'dan', 'dan', 42),
(45, 'LILI', 'NI', 'NN', NULL),
(55, 'CICI', 'CICI', 'CICI', 42),
(76, 'lis', 'l', 'l', NULL),
(78, 'julio', 'julio@gmail.com', '123', 44),
(123, 'cris', 'danoninho.danoni@gmail.com', '123', 25),
(789, 'tom', 'tom@gmail.tom', '04', 42),
(2222, 'vinic', 'voidzinho@gmail.com', 'lovenoni', 22),
(5789, 'chicolino', 'chicoooo@gmail.com', '55', NULL),
(8564, 'chico', 'chico@gmail.com', '7878', 44),
(66576, 'noni', 'b', '111', NULL),
(101010, 'giovana', 'gio@gmail.com', '04082728', 24),
(232323, 'vini', 'vininhodograu@gmail.com', 'amanoninho', NULL),
(786612, 'kk', 'll@gmail.com', '77', NULL),
(1111111, 'lulu', 'luiza@gmail.com', '11', 42),
(8288526, 'Morgana L.C', 'morgs@gmail.com', '0488', 4),
(8856655, 'manoel', 'manoel@gmail.com', '557', NULL),
(12121212, 'Joao', 'joao@gmail.com', '55', NULL),
(55448454, 'noni', 'danoninho.danoni@gmail.com', 'danoninho', NULL),
(78945612, 'Luiza', 'luiza@gmail.com', '10', 43),
(145797639, 'luiz', 'luiza@gmail.com', 'luiz', 45),
(451695314, 'Julia', 'julia@gmail.com', 'julia', 37),
(5866613092, 'lulu', 'soulindaemeamo@gmail.com', 'oiebosta', 37),
(6362425014, 'Danilo D', 'uepadanilo@gmail.com', 'amoanonita', 4),
(7894562301, 'Danilo', 'dalino@gamil.com', 'danilo', 24),
(12345678912, 'Void', 'meucool@gmail.com', '1234void', 24),
(60000917028, 'vinicius', 'viniciusvieiraroldao@gmail.com', '0808', 4),
(77777777777, 'Vini', 'vininhodograu@gmail.com', '0408', 40);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL,
  `idcar` bigint(100) NOT NULL,
  `idV` int(5) NOT NULL,
  `dataPedido` datetime DEFAULT current_timestamp(),
  `status` tinyint(1) DEFAULT 0,
  `cpf` bigint(12) DEFAULT NULL,
  `notificado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`idpedido`, `idcar`, `idV`, `dataPedido`, `status`, `cpf`, `notificado`) VALUES
(71, 137, 42, '2025-07-11 01:17:16', 1, NULL, 0),
(72, 138, 42, '2025-07-11 01:20:46', 0, NULL, 0),
(73, 139, 42, '2025-07-11 02:52:03', 1, NULL, 1),
(74, 140, 25, '2025-09-27 15:12:19', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `Codei` bigint(100) NOT NULL,
  `nomep` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `discricao` varchar(255) NOT NULL,
  `disponibilidade` tinyint(1) NOT NULL,
  `quantidade` bigint(50) NOT NULL,
  `valor` bigint(50) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`Codei`, `nomep`, `tipo`, `discricao`, `disponibilidade`, `quantidade`, `valor`, `img`) VALUES
(34, 'Recrescência ', 'Perfume', 'Doce marcante', 1, 557, 70, 'ftprodutos/figura1.jpg'),
(35, 'Roses', 'Batom', 'Vermelho vibrante', 0, 0, 15, 'ftprodutos/figura2.jpg'),
(37, 'Hidratante ', 'Creme ', 'Um hidratante leve', 0, 0, 66, 'ftprodutos/figura3.jpg'),
(38, 'Reis', 'Perfume', 'Perfume marcante', 0, 0, 60, 'ftprodutos/figura5.jpg'),
(39, 'Skincare para pele', 'Kit', 'Skincare completo ', 1, 29, 142, 'ftprodutos/figura6.jpg'),
(40, 'Make a todo momento', 'Kit', 'Maquiagem total', 0, 0, 90, 'ftprodutos/figura7.jpg'),
(41, 'Barbas e bigodes', 'Kit', 'Cuidados fortes', 1, 40, 200, 'ftprodutos/figura8.jpg'),
(42, 'Manicure pedicure', 'Kit', 'Brilhantes ', 1, 20, 200, 'ftprodutos/figura9.jpg'),
(60, 'Perfume de Rosas amarelas', 'Perfume', 'Perfeito para o dia à dia.', 1, 5, 50, 'ftprodutos/download (6).jpeg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendedora`
--

CREATE TABLE `vendedora` (
  `idV` int(5) NOT NULL,
  `cpf` bigint(12) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `ntele` bigint(11) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendedora`
--

INSERT INTO `vendedora` (`idV`, `cpf`, `nome`, `email`, `ntele`, `senha`) VALUES
(4, 55448454, 'noni', 'voidlindo@gmail.com', 45568, '7777'),
(10, 55448454, 'noni', 'danoninho.danoni@gmail.com', 45568, '8877888'),
(12, 55879994, 'Noninholya', 'danoni@gmail.com', 45568, '553959'),
(20, 34534, 'voidbb', 'voidlindomeu@gmail.com', 34982794, 'danoninho'),
(21, 55448454, 'noni', 'danoninho.danoni@gmail.com', 45568, 'danoninho'),
(22, 55448454, 'noni', 'danoninho.danoni@gmail.com', 45568, 'danoninho'),
(24, 111, 'nn', 'danoninho.danoni@gmail.com', 33, '11'),
(25, 21, 'ee', 'voidlindo@gmail.com', 22, '11'),
(35, 23, 'Nome do Revendedor', 'gmail.com', 222, 'senha'),
(36, 7894562307, 'Luiza', 'luiza@gmail.com', 51, 'luiza'),
(37, 7894561307, 'Gabi', 'gabi@gmail.com', 51, 'gabi'),
(38, 78945612301, 'Nat', 'nat@gmail', 34982794, '00'),
(39, 7878154, 'moenel', 'chicoshow@gmal.com', 99999999999, '040827'),
(40, 88888, 'Mika', 'Mika@gmail.com', 51, 'mika'),
(41, 222, 'Gabriela', 'gaby@gmail.com', 54233, '04'),
(42, 102365789546, 'Dani', 'Dani@gmail.com', 5336698, 'dani'),
(43, 236478954, 'be', 'be@gmail.com', 502236598, 'be'),
(44, 87995, 'Enzo b ', 'enzob@gmail.com', 88452, '777'),
(45, 86887696053, 'manu', 'danoninho.danoni@gmail.com', 4002892, 'manuu'),
(46, 48, 'lili', 'danoninho.danoni@gmail.com', 55, '44'),
(47, 77, 'noni', 'j', 4, '8');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`idcar`),
  ADD KEY `fk_Codei` (`Codei`),
  ADD KEY `fk_cpf` (`cpf`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cpf`),
  ADD KEY `fk_idV` (`idV`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `fk_pedidoIdcar` (`idcar`),
  ADD KEY `fk_revendedor` (`idV`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`Codei`);

--
-- Índices de tabela `vendedora`
--
ALTER TABLE `vendedora`
  ADD PRIMARY KEY (`idV`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `idcar` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `Codei` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `vendedora`
--
ALTER TABLE `vendedora`
  MODIFY `idV` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `fk_Codei` FOREIGN KEY (`Codei`) REFERENCES `produto` (`Codei`),
  ADD CONSTRAINT `fk_cpf` FOREIGN KEY (`cpf`) REFERENCES `cliente` (`cpf`);

--
-- Restrições para tabelas `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_idV` FOREIGN KEY (`idV`) REFERENCES `vendedora` (`idV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedidcpf` FOREIGN KEY (`cpf`) REFERENCES `cliente` (`cpf`),
  ADD CONSTRAINT `fk_pedidoIdcar` FOREIGN KEY (`idcar`) REFERENCES `carrinho` (`idcar`),
  ADD CONSTRAINT `fk_revendedor` FOREIGN KEY (`idV`) REFERENCES `vendedora` (`idV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
