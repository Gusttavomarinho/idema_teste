-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Set-2021 às 04:51
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

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
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `processos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`id`, `documento`, `create_at`, `update_at`, `processos_id`) VALUES
(4, 'Documento de teste 01', '2021-09-03 21:23:35', NULL, 3),
(5, 'Documento de teste 02', '2021-09-03 21:23:35', NULL, 3),
(6, 'O cuidado em identificar pontos críticos no acompanhamento das preferências de consumo representa uma abertura para a melhoria da gestão inovadora da qual fazemos parte.', '2021-09-03 21:38:37', NULL, 4),
(7, 'O empenho em analisar o desenvolvimento contínuo de distintas formas de atuação não pode mais se dissociar dos índices pretendidos.', '2021-09-03 21:38:37', NULL, 4),
(8, 'O cuidado em identificar pontos críticos na mobilidade dos capitais internacionais possibilita uma melhor visão global da gestão inovadora da qual fazemos parte.', '2021-09-03 21:38:57', NULL, 5),
(9, 'Documento testando 01', '2021-09-03 22:46:54', NULL, 6),
(10, 'Documento testando 02', '2021-09-03 22:46:54', NULL, 6),
(11, 'Documento testando 03', '2021-09-03 22:46:54', NULL, 6),
(12, 'Documento testando 04', '2021-09-03 22:46:54', NULL, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `processos`
--

CREATE TABLE `processos` (
  `id` int(11) NOT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `processos`
--

INSERT INTO `processos` (`id`, `create_at`, `update_at`, `users_id`) VALUES
(3, '2021-09-03 21:23:08', NULL, 2),
(4, '2021-09-03 21:37:53', NULL, 2),
(5, '2021-09-03 21:37:53', NULL, 2),
(6, '2021-09-03 22:46:17', NULL, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacoes`
--

CREATE TABLE `solicitacoes` (
  `id` int(11) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `users_id` int(11) NOT NULL,
  `data_aprovacao` datetime DEFAULT NULL,
  `user_id_aprovacao` int(11) DEFAULT NULL,
  `status_aprovacao` int(11) NOT NULL DEFAULT 0,
  `status_motivo` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `solicitacoes`
--

INSERT INTO `solicitacoes` (`id`, `nome_usuario`, `email_usuario`, `data`, `users_id`, `data_aprovacao`, `user_id_aprovacao`, `status_aprovacao`, `status_motivo`) VALUES
(48, 'GUSTAVO HENRIQUE MARINHO DE OLIVEIRA', 'gusttavomarinho@gmail.com', '2021-09-03 21:53:16', 2, '2021-09-03 23:41:51', 3, 1, 'teste teste '),
(49, 'GUSTAVO HENRIQUE MARINHO DE OLIVEIRA', 'gusttavomarinho@gmail.com', '2021-09-03 21:53:30', 2, NULL, NULL, 0, ''),
(50, 'GUSTAVO OLIVEIRA', 'gusttavomarinho@outlook.com', '2021-09-02 21:53:45', 2, '2021-09-03 22:45:49', 3, 1, 'Aprovado tudo ok!'),
(51, 'GUSTAVO OLIVEIRA 2', 'contato@gusttavodev.com', '2021-09-03 22:47:23', 2, '2021-09-03 22:48:00', 3, 2, 'Documento não pode ser disponibilizado !'),
(52, 'TESTE SEM NET', 'testesemnet@gmail.com', '2021-09-03 22:50:24', 2, '2021-09-03 22:56:49', 3, 0, '');

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
(48, 3),
(48, 4),
(48, 5),
(49, 3),
(49, 4),
(50, 5),
(51, 6),
(52, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `loginhash` varchar(255) DEFAULT NULL,
  `perfil` int(11) NOT NULL DEFAULT 2,
  `image` varchar(255) DEFAULT NULL,
  `ativo` int(11) NOT NULL DEFAULT 1,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `loginhash`, `perfil`, `image`, `ativo`, `create_at`, `update_at`, `deleted_at`) VALUES
(2, 'teste', '$2y$10$TssMEOqEo7uK3xjMZL/muudTOUS./7ao1iHxkg9ddsFfWkTx.hrC.', 'e9d2871eb08bf9471e8c231454cb6b3e', 2, NULL, 1, '2021-09-03 21:22:23', '2021-09-03 21:22:23', NULL),
(3, 'admin', '$2y$10$4ExPeVI.lhxjRm8mg9H7l./wYcNKp3vq3FRteG3z0DmHTpGbwv3em', '5a2cec56447843ec8c11036db978b0ef', 1, NULL, 1, '2021-09-03 21:40:26', '2021-09-03 21:40:26', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `processos`
--
ALTER TABLE `processos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
