-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mai 31, 2021 as 08:15 AM
-- Versão do Servidor: 5.1.41
-- Versão do PHP: 5.6.30

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `cadastro_pat`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `Id` binary(16) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `Fixo` varchar(15) DEFAULT NULL,
  `Tel` varchar(15) DEFAULT NULL,
  `Cpf` varchar(20) DEFAULT NULL,
  `Cep` varchar(8) DEFAULT NULL,
  `Logradouro` varchar(100) DEFAULT NULL,
  `Bairro` varchar(50) DEFAULT NULL,
  `Cidade` varchar(50) DEFAULT NULL,
  `Numero` varchar(10) DEFAULT NULL,
  `Complemento` varchar(50) DEFAULT NULL,
  `Estado` varchar(60) DEFAULT NULL,
  `Funcao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

CREATE TABLE IF NOT EXISTS `resposta` (
  `Id` binary(16) NOT NULL,
  `IdPessoa` binary(16) NOT NULL,
  `PrimeiraPergunta` varchar(100) DEFAULT NULL,
  `PrimeiraResposta` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `IdPessoa` (`IdPessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resposta`
--


--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `IdPessoa` FOREIGN KEY (`IdPessoa`) REFERENCES `pessoa` (`Id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
