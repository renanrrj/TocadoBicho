-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Out-2022 às 16:04
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_tocadobicho`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_animal`
--

CREATE TABLE `tb_animal` (
  `ani_Id` int(10) UNSIGNED NOT NULL,
  `ani_Nome` varchar(30) DEFAULT NULL,
  `ani_Especie` varchar(10) DEFAULT NULL,
  `ani_Raca` varchar(100) DEFAULT NULL,
  `ani_Peso` double DEFAULT NULL,
  `ani_Altura` double DEFAULT NULL,
  `ani_Endereco` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_carrinho`
--

CREATE TABLE `tb_carrinho` (
  `car_Id` int(10) UNSIGNED NOT NULL,
  `car_Id_Usuario` int(11) NOT NULL,
  `car_ValorFinal` double DEFAULT NULL,
  `car_id_FormaPagamento` int(11) DEFAULT NULL,
  `car_Parcelas` int(11) DEFAULT NULL,
  `car_fechado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categoriaproduto`
--

CREATE TABLE `tb_categoriaproduto` (
  `catpro_Id` int(10) UNSIGNED NOT NULL,
  `catpro_Nome` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_categoriaproduto`
--

INSERT INTO `tb_categoriaproduto` (`catpro_Id`, `catpro_Nome`) VALUES
(1, 'CatPro_Teste 1'),
(2, 'CatPro_Teste 2'),
(3, 'CatPro_Teste 3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clinica`
--

CREATE TABLE `tb_clinica` (
  `clin_Id` int(10) UNSIGNED NOT NULL,
  `clin_Nome` varchar(30) DEFAULT NULL,
  `clin_Telefone` varchar(15) DEFAULT NULL,
  `clin_Endereco` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_clinica`
--

INSERT INTO `tb_clinica` (`clin_Id`, `clin_Nome`, `clin_Telefone`, `clin_Endereco`) VALUES
(1, 'Clin_Nome 1', 'Clin_Tel 1', 'Clin_End 1'),
(2, 'Clin_Nome 2', 'Clin_Tel 2', 'Clin_End 2'),
(3, 'Clin_Nome 3', 'Clin_Tel 3', 'Clin_End 3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_compraproduto`
--

CREATE TABLE `tb_compraproduto` (
  `cp_Id` int(10) UNSIGNED NOT NULL,
  `cp_Id_Produto` int(11) DEFAULT NULL,
  `cp_Entregar` tinyint(1) DEFAULT NULL,
  `cp_Frete` double DEFAULT NULL,
  `cp_Carrinho_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_formapagamento`
--

CREATE TABLE `tb_formapagamento` (
  `fp_Id` int(10) UNSIGNED NOT NULL,
  `fp_Nome` varchar(30) DEFAULT NULL,
  `fp_Parcelavel` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto`
--

CREATE TABLE `tb_produto` (
  `pro_Id` int(11) NOT NULL,
  `pro_Nome` varchar(30) DEFAULT NULL,
  `pro_Preco` double DEFAULT NULL,
  `pro_Id_Categoria` int(11) DEFAULT NULL,
  `pro_detalhe` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `ur_Id` int(11) NOT NULL,
  `ur_Nome` varchar(30) DEFAULT NULL,
  `ur_Email` varchar(100) DEFAULT NULL,
  `ur_Senha` varchar(100) DEFAULT NULL,
  `ur_Pais` varchar(15) DEFAULT NULL,
  `ur_Estado` varchar(15) DEFAULT NULL,
  `ur_Cidade` varchar(15) DEFAULT NULL,
  `ur_Endereco` varchar(255) DEFAULT NULL,
  `ur_Administrador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_animal`
--
ALTER TABLE `tb_animal`
  ADD PRIMARY KEY (`ani_Id`);

--
-- Índices para tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  ADD PRIMARY KEY (`car_Id`),
  ADD KEY `car_Id_Usuario` (`car_Id_Usuario`);

--
-- Índices para tabela `tb_categoriaproduto`
--
ALTER TABLE `tb_categoriaproduto`
  ADD PRIMARY KEY (`catpro_Id`);

--
-- Índices para tabela `tb_clinica`
--
ALTER TABLE `tb_clinica`
  ADD PRIMARY KEY (`clin_Id`);

--
-- Índices para tabela `tb_compraproduto`
--
ALTER TABLE `tb_compraproduto`
  ADD PRIMARY KEY (`cp_Id`);

--
-- Índices para tabela `tb_formapagamento`
--
ALTER TABLE `tb_formapagamento`
  ADD PRIMARY KEY (`fp_Id`);

--
-- Índices para tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`pro_Id`);

--
-- Índices para tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`ur_Id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_animal`
--
ALTER TABLE `tb_animal`
  MODIFY `ani_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  MODIFY `car_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_categoriaproduto`
--
ALTER TABLE `tb_categoriaproduto`
  MODIFY `catpro_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_clinica`
--
ALTER TABLE `tb_clinica`
  MODIFY `clin_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_compraproduto`
--
ALTER TABLE `tb_compraproduto`
  MODIFY `cp_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_formapagamento`
--
ALTER TABLE `tb_formapagamento`
  MODIFY `fp_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `ur_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  ADD CONSTRAINT `tb_carrinho_ibfk_1` FOREIGN KEY (`car_Id_Usuario`) REFERENCES `tb_usuario` (`ur_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
