-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 04/12/2017 às 02:23
-- Versão do servidor: 10.1.25-MariaDB
-- Versão do PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lojaModelo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_produtos`
--

CREATE TABLE `tbl_produtos` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tags_produto` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `preco_produto` float(100,2) NOT NULL,
  `url_produto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `categoria_produto` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `tbl_produtos`
--

INSERT INTO `tbl_produtos` (`id_produto`, `nome_produto`, `tags_produto`, `preco_produto`, `url_produto`, `descricao`, `categoria_produto`) VALUES
(1, 'Camiseta Megadeth countdown', '', 50.00, 'assets/img/produtos/camiseta-megadeth-countdown-to-extinction.jpg', 'Camiseta do álbum Countdown to Extinction da banda de metal Megadeth', 'roupa'),
(2, 'Camiseta Megadeth Mascote', '', 45.00, 'assets/img/produtos/camiseta-megadeth-mascote.jpg', 'Camiseta com estampa do mascote Vic Rattlehead da banda de metal Megadeth', 'roupa'),
(3, 'Modelo de camiseta', '', 50.00, 'assets/img/produtos/modelo.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'roupa'),
(4, 'Modelo de camisa (2)', '', 0.00, 'assets/img/produtos/modelo.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'roupa'),
(5, 'Modelo de camiseta (3)', '', 50.00, 'assets/img/produtos/modelo.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'roupa'),
(6, 'Modelo de camisa (4)', '', 50.00, 'assets/img/produtos/modelo.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'roupa'),
(7, 'Camiseta Megadeth Mascote', '', 45.00, 'assets/img/produtos/camiseta-megadeth-mascote.jpg', 'Camiseta com estampa do mascote Vic Rattlehead da banda de metal Megadeth', 'roupa'),
(8, 'Modelo de camiseta', '', 50.00, 'assets/img/produtos/modelo.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'roupa'),
(9, 'Camiseta Megadeth countdown', '', 50.00, 'assets/img/produtos/camiseta-megadeth-countdown-to-extinction.jpg', 'Camiseta do álbum Countdown to Extinction da banda de metal Megadeth', 'roupa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_users`
--

CREATE TABLE `tbl_users` (
  `con_in_id` int(11) NOT NULL,
  `con_st_nome` char(200) DEFAULT NULL,
  `con_st_senha` char(200) DEFAULT NULL,
  `con_st_email` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tbl_users`
--

INSERT INTO `tbl_users` (`con_in_id`, `con_st_nome`, `con_st_senha`, `con_st_email`) VALUES
(1, 'TEXTE', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'TEXTE@HUEHUE.com'),
(2, 'Mark', 'd54b76b2bad9d9946011ebc62a1d272f4122c7b5', 'luan_mark13@hotmail.com'),
(3, 'Test', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Mark@gmail.com'),
(4, 'Lord Mark asdad linguiÃ§a Ã© muito bom', '12f163846ed9fa6c45bf9a00f0869ff83059f2e1', 'asdasd@gmail.com'),
(11, 'Outro teste', '12f163846ed9fa6c45bf9a00f0869ff83059f2e1', 'hehe@gmail.com');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tbl_produtos`
--
ALTER TABLE `tbl_produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`con_in_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tbl_produtos`
--
ALTER TABLE `tbl_produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de tabela `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `con_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
