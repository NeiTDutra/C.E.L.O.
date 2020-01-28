-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 01-Out-2019 às 08:29
-- Versão do servidor: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pjcelo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcliente`
--

CREATE TABLE `tbcliente` (
  `cod_cli` int(8) UNSIGNED ZEROFILL NOT NULL,
  `nome_cli` varchar(30) COLLATE utf8_bin NOT NULL,
  `fone_cli` varchar(15) COLLATE utf8_bin NOT NULL,
  `email_cli` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tbcliente`
--

INSERT INTO `tbcliente` (`cod_cli`, `nome_cli`, `fone_cli`, `email_cli`) VALUES
(00000001, 'Fulano de tal', '51 98765-8658', 'futl@ful.net'),
(00000002, 'Fulano T. de Almeida', '51 99876-5459', 'ggg@nnn.mm'),
(00000003, 'Joaquin', '55 98456-7656', 'ggg@nnn.mm'),
(00000004, 'Beltrano', '54 97666-6667', 'ggg@nnn.mm'),
(00000005, 'Jardael Fontes MilÃ£o', '55 93057-2662', 'jdlfntml@grte.com'),
(00000006, 'Agenor  Mascavo Root', '54 87658-9090', 'agmart@mmm.com'),
(00000007, 'Marcelino Ramos', '54  9887-6546', 'marram@mail.com'),
(00000008, 'Raquel Korostric', '81 97556-7443', 'raquelk@mmm.com'),
(00000009, 'Jaquirana Balalaia', '66 66666-6666', 'jaqui@jac.mnb');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tborcamento`
--

CREATE TABLE `tborcamento` (
  `cod_orc` int(8) UNSIGNED ZEROFILL NOT NULL,
  `cod_usu_orc` int(8) UNSIGNED ZEROFILL NOT NULL,
  `nome_usu_orc` varchar(30) COLLATE utf8_bin NOT NULL,
  `cod_cli_orc` int(8) UNSIGNED ZEROFILL NOT NULL,
  `nome_cli_orc` varchar(30) COLLATE utf8_bin NOT NULL,
  `fone_cli_orc` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tborcamento`
--

INSERT INTO `tborcamento` (`cod_orc`, `cod_usu_orc`, `nome_usu_orc`, `cod_cli_orc`, `nome_cli_orc`, `fone_cli_orc`) VALUES
(00000039, 00000001, 'Nei', 00000004, 'Beltrano', '54 97666-6667'),
(00000049, 00000001, 'Nei', 00000007, 'Marcelino Ramos', '54  9887-6546'),
(00000050, 00000001, 'Nei', 00000009, 'Jaquirana Balalaia', '66 66666-6666'),
(00000051, 00000001, 'Nei', 00000009, 'Jaquirana Balalaia', '66 66666-6666');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tborcamento_i`
--

CREATE TABLE `tborcamento_i` (
  `cod_orc` int(8) UNSIGNED ZEROFILL NOT NULL,
  `id_prod` int(8) UNSIGNED ZEROFILL NOT NULL,
  `desc_prod` varchar(30) COLLATE utf8_bin NOT NULL,
  `tam_prod` varchar(2) COLLATE utf8_bin NOT NULL,
  `cor_prod` varchar(20) COLLATE utf8_bin NOT NULL,
  `quant_prod` int(8) NOT NULL,
  `valor_prod` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tborcamento_i`
--

INSERT INTO `tborcamento_i` (`cod_orc`, `id_prod`, `desc_prod`, `tam_prod`, `cor_prod`, `quant_prod`, `valor_prod`) VALUES
(00000039, 00000008, 'calÃ§a sarja cargo', 'M', 'chumbo', 6, '27.90'),
(00000039, 00000006, 'camiseta gola v', 'G', 'branco', 6, '25.00'),
(00000049, 00000010, 'jaqueta nylon c/ ribana', 'G', 'preto', 2, '35.00'),
(00000049, 00000009, 'calÃ§a sarja cargo', 'G', 'chumbo', 5, '27.90'),
(00000050, 00000010, 'jaqueta nylon c/ ribana', 'G', 'preto', 3, '35.00'),
(00000050, 00000009, 'calÃ§a sarja cargo', 'G', 'chumbo', 3, '27.90'),
(00000050, 00000011, 'camiseta manga comprida', 'M', 'branco', 3, '15.89'),
(00000051, 00000008, 'calÃ§a sarja cargo', 'M', 'chumbo', 45, '27.90'),
(00000051, 00000011, 'camiseta manga comprida', 'M', 'branco', 35, '15.89'),
(00000051, 00000003, 'jaleco c manga sem gola', 'M', 'chumbo', 30, '35.50'),
(00000050, 00000008, 'calÃ§a sarja cargo', 'M', 'chumbo', 45, '27.90');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

CREATE TABLE `tbproduto` (
  `id_prod` int(8) UNSIGNED ZEROFILL NOT NULL,
  `desc_prod` varchar(50) COLLATE utf8_bin NOT NULL,
  `tam_prod` varchar(20) COLLATE utf8_bin NOT NULL,
  `cor_prod` varchar(20) COLLATE utf8_bin NOT NULL,
  `quant_prod` int(8) NOT NULL,
  `valor_prod` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tbproduto`
--

INSERT INTO `tbproduto` (`id_prod`, `desc_prod`, `tam_prod`, `cor_prod`, `quant_prod`, `valor_prod`) VALUES
(00000001, 'camiseta manga compriida gola v', 'M', 'preta', 30, '25.00'),
(00000002, 'jaleco c manga sem gola', 'GG', 'chumbo', 46, '35.50'),
(00000003, 'jaleco c manga sem gola', 'M', 'chumbo', 23, '35.50'),
(00000004, 'jaleco c manga sem gola', 'G', 'azul', 26, '34.90'),
(00000005, 'camiseta manga curta', 'M', 'branco', 35, '15.49'),
(00000006, 'camiseta manga curta gola v', 'G', 'branco', 45, '25.00'),
(00000008, 'calÃ§a sarja cargo', 'M', 'chumbo', 45, '27.90'),
(00000009, 'calÃ§a sarja cargo', 'G', 'chumbo', 50, '27.90'),
(00000010, 'jaqueta nylon c/ ribana', 'G', 'preto', 50, '35.00'),
(00000011, 'camiseta manga comprida', 'M', 'branco', 35, '15.89');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `cod_usu` int(8) UNSIGNED ZEROFILL NOT NULL,
  `nome_usu` varchar(30) COLLATE utf8_bin NOT NULL,
  `senha_usu` varchar(20) COLLATE utf8_bin NOT NULL,
  `nivel_usu` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`cod_usu`, `nome_usu`, `senha_usu`, `nivel_usu`) VALUES
(00000001, 'Nei', 'MDA=', 100),
(00000021, 'Thomas Edison', 'MDI5OA==', 100),
(00000022, 'Albert Heinsten', 'ZT1tYzI=', 100),
(00000023, 'Bil Gates', 'bXNp', 10),
(00000024, 'Linus Torvalds', 'bGludXg=', 100),
(00000025, 'Santos Dumont', 'YXZpYW8=', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`cod_cli`);

--
-- Indexes for table `tborcamento`
--
ALTER TABLE `tborcamento`
  ADD PRIMARY KEY (`cod_orc`);

--
-- Indexes for table `tborcamento_i`
--
ALTER TABLE `tborcamento_i`
  ADD KEY `id_orcamento` (`cod_orc`),
  ADD KEY `cod_orc` (`cod_orc`);

--
-- Indexes for table `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD PRIMARY KEY (`id_prod`);

--
-- Indexes for table `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`cod_usu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbcliente`
--
ALTER TABLE `tbcliente`
  MODIFY `cod_cli` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tborcamento`
--
ALTER TABLE `tborcamento`
  MODIFY `cod_orc` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `tbproduto`
--
ALTER TABLE `tbproduto`
  MODIFY `id_prod` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `cod_usu` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
