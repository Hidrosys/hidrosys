-- Alteração em 20/10/2014

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` text NOT NULL,
  `email` text NOT NULL,
  `telefone` text NOT NULL,
  `tipo` int(11) NOT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `email`, `telefone`, `tipo`) VALUES
(1, 'admin', 'admin', 'YWRtaW4=', '', '', 1);

----------------------------------------------------------


-- Alteração em 22/10/2014

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

----------------------------------------------------------

-- Alteração em 11/11/2014

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

----------------------------------------------------------
