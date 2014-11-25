-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25-Nov-2014 às 11:05
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hidrosys`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `endereco` text NOT NULL,
  `cep` text NOT NULL,
  `telefone` text NOT NULL,
  `cpf` text NOT NULL,
  `email` text NOT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `endereco`, `cep`, `telefone`, `cpf`, `email`, `deleted`, `deleted_date`) VALUES
(1, 'Thiago', 'Rua Nova', '37466-000', '(35) 9999-9999', '111.111.111-00', 'thiago.carvp@gmail.com', 0, NULL),
(2, 'Junior', 'Rua', '11111-111', '(35) 9999-9999', '111.111.111-11', 'renan@gmail.com', 1, '2014-11-17'),
(3, 'Fabiano', 'Rua -[]', '11111-112', '(99) 9999-9999', '111.111.111-11', 'fabiano@email.com', 0, NULL),
(4, 'Junior', 'Rua', '11111-112', '(35)9999-9999', '111.111.111-11', 'junior.andrade.cco@gmail.com', 0, NULL),
(5, 'asdf', 'rua', '11111-113', '(99) 9999-9999', '111.111.111-11', 'email@email.com', 0, NULL),
(6, 'asdf', 'rua', '11111-113', '(99) 9999-9999', '111.111.111-11', 'email@email.com', 0, NULL),
(7, 'Souza e Companhia', 'rua manÃ©', '12280-060', '(99) 9999-9999', '111.111.111-11', 'renansouzadaniel@yahoo.com.br', 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ferramentas`
--

CREATE TABLE IF NOT EXISTS `ferramentas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text NOT NULL,
  `tipo` text NOT NULL,
  `quantidade` int(11) NOT NULL,
  `fabricante` text NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `deleted_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `ferramentas`
--

INSERT INTO `ferramentas` (`id`, `descricao`, `tipo`, `quantidade`, `fabricante`, `deleted`, `deleted_date`) VALUES
(1, 'Furadeira Stihl', 'Furadeira', 4, 'Stihl', 0, '0000-00-00'),
(2, 'khkkj', 'uiyiu', 9, 'kjkj', 0, '0000-00-00'),
(3, 'Martelo', 'Martelo', 3, 'Inox', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datanasc` text NOT NULL,
  `rg` text NOT NULL,
  `cpf` text NOT NULL,
  `endereco` text NOT NULL,
  `email` text NOT NULL,
  `ocupacao` text NOT NULL,
  `salario` int(11) NOT NULL,
  `prehora` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `telefone` text NOT NULL,
  `nome` text NOT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `datanasc`, `rg`, `cpf`, `endereco`, `email`, `ocupacao`, `salario`, `prehora`, `status`, `telefone`, `nome`, `deleted`, `deleted_date`) VALUES
(1, '-11', 'MG 91919191', '111.111.111-11', 'Rua', 'email@email.com', 'Secretario', 3500, 26, 0, '(99) 9999-9999', 'Junior', 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pecas`
--

CREATE TABLE IF NOT EXISTS `pecas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text NOT NULL,
  `tipo` text NOT NULL,
  `quantidade` int(11) NOT NULL,
  `precoun` double NOT NULL,
  `fabricante` text NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `deleted_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `pecas`
--

INSERT INTO `pecas` (`id`, `descricao`, `tipo`, `quantidade`, `precoun`, `fabricante`, `deleted`, `deleted_date`) VALUES
(1, 'Parafuso', 'Parafuso', 5, 0.14, 'Inoxoni', 0, '0000-00-00'),
(2, 'Parafuso', 'Parafuso', 30, 0.42, 'Inoxoni', 1, '0000-00-00'),
(3, 'Prego', 'Prego', 20, 6, 'Inox', 0, '0000-00-00'),
(4, 'ioioio', 'ioioio', 42, 4.1, 'inox', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE IF NOT EXISTS `servicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `hora_inicio` text NOT NULL,
  `hora_fim` text NOT NULL,
  `valor` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `deleted_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id`, `id_cliente`, `descricao`, `hora_inicio`, `hora_fim`, `valor`, `dia`, `mes`, `ano`, `deleted`, `deleted_date`) VALUES
(1, 1, 'InstalaÃ§Ã£o', '12:00', '17:00', 3000, 29, 11, 2014, 1, 11),
(2, 1, 'IntalaÃ§Ã£o de primeira', '9:00', '14:00', 2000, 30, 11, 2014, 1, 11),
(4, 7, 'InstalaÃ§Ã£o de Aquecedor ', '12:00', '17:00', 3000, 30, 11, 2014, 1, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos_ferramentas`
--

CREATE TABLE IF NOT EXISTS `servicos_ferramentas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servico` int(11) NOT NULL,
  `id_ferramenta` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `servicos_ferramentas`
--

INSERT INTO `servicos_ferramentas` (`id`, `id_servico`, `id_ferramenta`, `quantidade`) VALUES
(3, 2, 1, 2),
(4, 4, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos_funcionarios`
--

CREATE TABLE IF NOT EXISTS `servicos_funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servico` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `servicos_funcionarios`
--

INSERT INTO `servicos_funcionarios` (`id`, `id_servico`, `id_funcionario`, `valor`) VALUES
(3, 2, 1, 30),
(5, 4, 1, 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos_pecas`
--

CREATE TABLE IF NOT EXISTS `servicos_pecas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servico` int(11) NOT NULL,
  `id_peca` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `servicos_pecas`
--

INSERT INTO `servicos_pecas` (`id`, `id_servico`, `id_peca`, `quantidade`) VALUES
(1, 2, 1, 5),
(2, 4, 1, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` text NOT NULL,
  `email` text NOT NULL,
  `telefone` text NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) DEFAULT '0',
  `deleted_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `email`, `telefone`, `tipo`, `deleted`, `deleted_date`) VALUES
(1, 'Thiago  Carvalho', 'thiago', 'MTIz', 'thiago.carvp@gmail.com', '(35) 9999-9999', 1, 0, '0000-00-00'),
(5, 'Renan Souza', 'renan', 'MTIz', 'renan@gmail.com', '(00) 8999-9999', 0, 0, '2014-11-04'),
(8, 'Junior', 'junior', 'MTIz', '', '', 1, 0, NULL),
(9, 'Claudia', 'claudia', 'MTIz', 'claudia@email.com', '(35) 8888-8888', 1, 0, NULL),
(10, 'admin', 'admin', 'YWRtaW4=', '', '', 1, 0, NULL),
(11, 'Fabiano', 'fabiano', 'MTIz', 'fabiano@email.com', '(99) 9999-9999', 1, 1, '2014-11-12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
