-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Set-2021 às 19:09
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `idema`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `documento` longtext NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `processos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`id`, `documento`, `create_at`, `processos_id`) VALUES
(1, 'oifdjgofdjoigfdjoigjodif', '2021-09-03 10:53:54', 1),
(2, 'oifdjgfdijgoifdgjfd oigjfdfd\r\n\r\ngfdogfdjoig', '2021-09-03 10:54:12', 1),
(3, 'fefsdef3q32534534', '2021-09-03 15:54:40', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `processos`
--

CREATE TABLE `processos` (
  `id` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `processos`
--

INSERT INTO `processos` (`id`, `create_at`, `users_id`) VALUES
(1, '2021-09-03 10:53:38', 5),
(2, '2021-09-03 10:54:29', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacoes`
--

CREATE TABLE `solicitacoes` (
  `id` int(11) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `solicitacoes`
--

INSERT INTO `solicitacoes` (`id`, `nome_usuario`, `email_usuario`, `data`, `users_id`) VALUES
(2, 'Gustavo Marinho', 'gusttavomarinho@gmail.com', '2021-09-03 16:04:27', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacoes_has_processos`
--

CREATE TABLE `solicitacoes_has_processos` (
  `solicitacoes_id` int(11) NOT NULL,
  `processos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `solicitacoes_has_processos`
--

INSERT INTO `solicitacoes_has_processos` (`solicitacoes_id`, `processos_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `loginhash` varchar(255) DEFAULT NULL,
  `perfil` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ativo` int(11) NOT NULL DEFAULT 1,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `loginhash`, `perfil`, `image`, `ativo`, `create_at`, `update_at`, `deleted_at`) VALUES
(1, 'gustavo', '1234', NULL, 1, NULL, 1, '2021-09-03 10:53:20', '2021-09-03 10:53:20', '2021-09-03 15:53:19'),
(5, 'teste', '$2y$10$.m2YwAD6N0vwT7z1K6kF.uFp/DH439JzWNDL1aPvOGpce5HHmDYsm', 'e24fef731df007be6a74f55a794a4172', 2, NULL, 1, '2021-09-03 16:44:56', '2021-09-03 16:44:56', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_documentos_processos1_idx` (`processos_id`);

--
-- Índices para tabela `processos`
--
ALTER TABLE `processos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_processos_users_idx` (`users_id`);

--
-- Índices para tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_solicitacoes_users1_idx` (`users_id`);

--
-- Índices para tabela `solicitacoes_has_processos`
--
ALTER TABLE `solicitacoes_has_processos`
  ADD PRIMARY KEY (`solicitacoes_id`,`processos_id`),
  ADD KEY `fk_solicitacoes_has_processos_processos1_idx` (`processos_id`),
  ADD KEY `fk_solicitacoes_has_processos_solicitacoes1_idx` (`solicitacoes_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `processos`
--
ALTER TABLE `processos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `fk_documentos_processos1` FOREIGN KEY (`processos_id`) REFERENCES `processos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `processos`
--
ALTER TABLE `processos`
  ADD CONSTRAINT `fk_processos_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD CONSTRAINT `fk_solicitacoes_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `solicitacoes_has_processos`
--
ALTER TABLE `solicitacoes_has_processos`
  ADD CONSTRAINT `fk_solicitacoes_has_processos_processos1` FOREIGN KEY (`processos_id`) REFERENCES `processos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_solicitacoes_has_processos_solicitacoes1` FOREIGN KEY (`solicitacoes_id`) REFERENCES `solicitacoes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
