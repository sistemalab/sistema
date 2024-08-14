-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/08/2024 às 03:45
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
-- Banco de dados: `sistemadereservalab`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm`
--

CREATE TABLE `adm` (
  `Usuario` varchar(225) NOT NULL,
  `Senha` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `adm`
--

INSERT INTO `adm` (`Usuario`, `Senha`) VALUES
('LoginAdm', 'Ifam2013');

-- --------------------------------------------------------

--
-- Estrutura para tabela `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id_laboratorio` int(11) NOT NULL,
  `numero_laboratorio` int(11) NOT NULL,
  `manuntencao` tinyint(1) DEFAULT NULL,
  `disponivel` tinyint(1) DEFAULT NULL,
  `numero_computadores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `laboratorio`
--

INSERT INTO `laboratorio` (`id_laboratorio`, `numero_laboratorio`, `manuntencao`, `disponivel`, `numero_computadores`) VALUES
(1, 38, 0, 1, 0),
(2, 40, 0, 1, 0),
(3, 44, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `siape` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`siape`, `nome`, `email`, `senha`, `ativo`) VALUES
(5403, 'Silvio', 'silviovieira@gmail.com', 'silvio555', 1),
(22399, 'André', 'andrejacoschneider@gmail.com', 'andrejac123', 1),
(78870, 'Spies', 'eduardohenriquespies@gmail.com', 'eduardospies', 1),
(293332, 'Rádeo', 'radeo321@gmail.com', 'radeoifam2024', 1);

--
-- Acionadores `professor`
--
DELIMITER $$
CREATE TRIGGER `RemoveCommaBeforeUpdate` BEFORE UPDATE ON `professor` FOR EACH ROW BEGIN
    SET NEW.nome = REPLACE(NEW.nome, ',', '');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `dia` date NOT NULL,
  `periodo` enum('manha','tarde','noite') NOT NULL,
  `laboratorio` int(11) NOT NULL,
  `professor` varchar(50) NOT NULL,
  `horario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`Usuario`);

--
-- Índices de tabela `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`numero_laboratorio`),
  ADD UNIQUE KEY `unico_numeroLab` (`numero_laboratorio`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`siape`);

--
-- Índices de tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `laboratorio` (`laboratorio`),
  ADD KEY `professor` (`professor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
