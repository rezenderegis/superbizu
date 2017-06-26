{\rtf1\ansi\ansicpg1252\cocoartf1347\cocoasubrtf570
{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural

\f0\fs24 \cf0 -- phpMyAdmin SQL Dump\
-- version 4.2.10\
-- http://www.phpmyadmin.net\
--\
-- Host: localhost:8889\
-- Generation Time: Mar 15, 2016 at 02:50 AM\
-- Server version: 5.5.38\
-- PHP Version: 5.5.18\
\
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";\
SET time_zone = "+00:00";\
\
--\
-- Database: `bizu`\
--\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `empresa`\
--\
\
CREATE TABLE `empresa` (\
`idempresa` int(11) unsigned NOT NULL,\
  `nome_empresa` varchar(45) DEFAULT NULL,\
  `telefone` varchar(11) DEFAULT NULL,\
  `cnpj` varchar(45) DEFAULT NULL,\
  `idusuario` int(11) DEFAULT NULL,\
  `tipoEmpresa` int(11) DEFAULT NULL COMMENT '1 - Bar, 2 - Restaurante, 3 - Empresa Convencional',\
  `tipoContaEmpresa` int(11) DEFAULT NULL COMMENT '1 - Single, 2 - Multi',\
  `sincronizacaoRegistroProduto` varchar(1) DEFAULT 'N',\
  `sincronizacaoFechamentoVenda` varchar(1) DEFAULT 'N',\
  `sincronizacaoEntradaAplicativo` varchar(1) DEFAULT 'N'\
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `empresa`\
--\
\
INSERT INTO `empresa` (`idempresa`, `nome_empresa`, `telefone`, `cnpj`, `idusuario`, `tipoEmpresa`, `tipoContaEmpresa`, `sincronizacaoRegistroProduto`, `sincronizacaoFechamentoVenda`, `sincronizacaoEntradaAplicativo`) VALUES\
(7, 'asdfasdf', NULL, NULL, 165, 3, 2, 'N', 'N', 'N'),\
(8, 'juca', NULL, NULL, 167, 3, 2, 'N', 'N', 'N'),\
(9, 'calbi', NULL, NULL, 169, 3, 2, 'N', 'N', 'N'),\
(10, 'calbi', NULL, NULL, 170, 3, 2, 'N', 'N', 'N'),\
(11, 'Bizu Quest\'f5es', '', '', 171, 0, 0, 'N', 'N', 'N'),\
(12, 'Alub Preparat\'f3rio para Vestibulares', '', '', 171, 0, 0, 'N', 'N', 'N'),\
(13, 'Conta Teste', '(344) 3', '8484844', 171, 0, 0, 'N', 'N', 'S'),\
(14, 'professor fulano', NULL, NULL, 177, 3, 2, 'N', 'N', 'N');\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `lista_questoes`\
--\
\
CREATE TABLE `lista_questoes` (\
`idListaQuestoes` int(11) NOT NULL,\
  `descricao` varchar(255) NOT NULL,\
  `idEmpresa` int(11) NOT NULL,\
  `idResponsavel` int(11) NOT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `lista_questoes`\
--\
\
INSERT INTO `lista_questoes` (`idListaQuestoes`, `descricao`, `idEmpresa`, `idResponsavel`) VALUES\
(1, 'Lista Escola 11', 11, 171),\
(2, 'Lista empresa 12', 12, 171),\
(3, 'Lista prof fulano', 14, 177);\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `log_usuario`\
--\
\
CREATE TABLE `log_usuario` (\
  `id` int(11) NOT NULL,\
  `id_questao` int(11) NOT NULL,\
  `id_usuario` int(11) NOT NULL,\
  `descricao` varchar(3000) CHARACTER SET latin1 NOT NULL,\
  `dt_alteracao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'mmmm',\
  `comentario_questao` varchar(2000) DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `log_usuario`\
--\
\
INSERT INTO `log_usuario` (`id`, `id_questao`, `id_usuario`, `descricao`, `dt_alteracao`, `comentario_questao`) VALUES\
(0, 0, 171, 'Entrou no sistema', '2016-03-12 14:52:43', ''),\
(0, 0, 172, 'Entrou no sistema', '2016-03-12 14:53:07', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-12 18:08:31', ''),\
(0, 1, 171, 'Cadastrou Quest\'e3o', '2016-03-12 18:18:20', 'Coment\'e1rio Inserido teste'),\
(0, 2, 171, 'Cadastrou Quest\'e3o', '2016-03-12 18:39:52', 'Coment\'e1rio Inserido asdfasdf'),\
(0, 0, 177, 'Entrou no sistema', '2016-03-12 19:43:00', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-12 19:49:20', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-12 20:00:02', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-12 20:00:49', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-12 20:01:13', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-12 20:06:38', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-12 22:05:34', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-12 22:06:15', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-12 22:14:25', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-12 22:20:52', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-13 21:13:16', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-13 21:13:47', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-13 21:46:03', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-13 21:52:54', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 19:26:34', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-14 19:26:48', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 19:41:17', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-14 19:41:39', ''),\
(0, 3, 177, 'Cadastrou Quest\'e3o', '2016-03-14 19:48:55', 'Coment\'e1rio Inserido prof fulano'),\
(0, 4, 177, 'Cadastrou Quest\'e3o', '2016-03-14 19:59:16', 'Coment\'e1rio Inserido asdf'),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 20:28:41', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 20:52:47', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 20:58:41', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-14 20:59:02', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 20:59:14', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 21:05:12', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 21:13:10', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 21:21:52', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 21:28:54', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 21:29:07', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-14 22:13:02', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 22:14:47', ''),\
(0, 0, 177, 'Entrou no sistema', '2016-03-14 22:15:12', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 22:15:26', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 23:31:20', ''),\
(0, 0, 171, 'Entrou no sistema', '2016-03-14 23:46:26', '');\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `perfil_descricao`\
--\
\
CREATE TABLE `perfil_descricao` (\
  `idperfil` int(11) NOT NULL,\
  `nomeperfil` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `perfil_usuario`\
--\
\
CREATE TABLE `perfil_usuario` (\
  `idusuarioempresa` int(11) DEFAULT NULL,\
  `idperfil` int(11) DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;\
\
--\
-- Dumping data for table `perfil_usuario`\
--\
\
INSERT INTO `perfil_usuario` (`idusuarioempresa`, `idperfil`) VALUES\
(15, 2),\
(16, 2),\
(17, 2),\
(18, 3),\
(19, 3),\
(20, 3),\
(22, 3),\
(23, 2),\
(24, 3),\
(25, 3),\
(26, 3),\
(27, 3),\
(28, 3),\
(29, 3),\
(30, 3),\
(31, 3);\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `pessoa`\
--\
\
CREATE TABLE `pessoa` (\
  `idpessoa` varchar(50) NOT NULL,\
  `nome` varchar(45) DEFAULT NULL,\
  `telefone` varchar(45) DEFAULT NULL,\
  `email` varchar(255) DEFAULT NULL,\
  `site` varchar(255) DEFAULT NULL,\
  `endereco` varchar(255) DEFAULT NULL,\
  `idempresa` int(11) NOT NULL DEFAULT '0',\
  `dt_primeira_sincronizacao` datetime DEFAULT NULL,\
  `dt_ultima_sincronizacao` datetime DEFAULT NULL,\
  `dt_criacao_site` datetime DEFAULT NULL,\
  `dt_alteracao_site` datetime DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `questao_lista`\
--\
\
CREATE TABLE `questao_lista` (\
  `idListaQuestao` int(11) NOT NULL,\
  `idQuestao` int(11) NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `questao_lista`\
--\
\
INSERT INTO `questao_lista` (`idListaQuestao`, `idQuestao`) VALUES\
(1, 1),\
(2, 2),\
(3, 3);\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `tb_aluno_grupo`\
--\
\
CREATE TABLE `tb_aluno_grupo` (\
`idAlunoGrupo` int(11) NOT NULL,\
  `idUsuario` int(11) DEFAULT NULL,\
  `idEmpresa` int(11) DEFAULT NULL,\
  `idGrupo` int(11) DEFAULT NULL,\
  `situacaoAlunoGrupo` int(11) DEFAULT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `tb_aluno_grupo`\
--\
\
INSERT INTO `tb_aluno_grupo` (`idAlunoGrupo`, `idUsuario`, `idEmpresa`, `idGrupo`, `situacaoAlunoGrupo`) VALUES\
(1, 173, 11, 7, 1),\
(2, 174, 11, 7, 1),\
(3, 179, 14, 10, 1),\
(4, 180, 14, 10, 1);\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `tb_assunto`\
--\
\
CREATE TABLE `tb_assunto` (\
`ID_ASSUNTO` int(11) NOT NULL,\
  `DESCRICAO_ASSUNTO` varchar(2000) DEFAULT NULL,\
  `ID_MATERIA` int(11) NOT NULL,\
  `ID_ASSUNTO_PAI` int(11) DEFAULT NULL,\
  `ID_DONO` int(11) DEFAULT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `tb_assunto`\
--\
\
INSERT INTO `tb_assunto` (`ID_ASSUNTO`, `DESCRICAO_ASSUNTO`, `ID_MATERIA`, `ID_ASSUNTO_PAI`, `ID_DONO`) VALUES\
(1, 'Pontuacao', 14, 0, 11),\
(2, 'Matematica basica', 14, 0, 12),\
(3, 'Assunto professor fulano', 14, 0, 14);\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `tb_assunto_questao`\
--\
\
CREATE TABLE `tb_assunto_questao` (\
  `ID_ASSUNTO` int(11) NOT NULL,\
  `ID_QUESTAO` int(11) NOT NULL,\
  `ID_DONO` int(11) DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `tb_assunto_questao`\
--\
\
INSERT INTO `tb_assunto_questao` (`ID_ASSUNTO`, `ID_QUESTAO`, `ID_DONO`) VALUES\
(1, 1, NULL),\
(2, 2, NULL),\
(3, 3, NULL),\
(3, 4, NULL);\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `tb_competencias`\
--\
\
CREATE TABLE `tb_competencias` (\
  `ID_COMPETENCIA` int(11) NOT NULL,\
  `NOME_COMPETENCIA` varchar(45) DEFAULT NULL,\
  `ID_DONO` int(11) DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `tb_grupo`\
--\
\
CREATE TABLE `tb_grupo` (\
`idGrupo` int(11) NOT NULL,\
  `responsavelGrupo` int(11) DEFAULT NULL,\
  `empresaGrupo` int(11) DEFAULT NULL,\
  `nomeGrupo` varchar(255) DEFAULT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `tb_grupo`\
--\
\
INSERT INTO `tb_grupo` (`idGrupo`, `responsavelGrupo`, `empresaGrupo`, `nomeGrupo`) VALUES\
(7, 171, 11, '5 S\'e9rie A'),\
(8, 171, 12, '8 Ano'),\
(9, 177, 14, 'aqui'),\
(10, 177, 14, 'grupo professor fulano');\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `tb_habilidades`\
--\
\
CREATE TABLE `tb_habilidades` (\
`ID_HABILIDADE` int(11) NOT NULL,\
  `TB_COMPETENCIAS_ID_COMPETENCIA` int(11) NOT NULL,\
  `DESCRICAO_HABILIDADE` varchar(500) DEFAULT NULL,\
  `ID_DONO` int(11) DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `tb_item`\
--\
\
CREATE TABLE `tb_item` (\
`ID_ITEM` int(11) NOT NULL,\
  `ID_QUESTAO` int(11) NOT NULL,\
  `DESCRICAO` varchar(2000) DEFAULT NULL,\
  `SITUACAO_ITEM` int(11) DEFAULT NULL,\
  `NOME_IMAGEM_ITEM` varchar(100) DEFAULT NULL,\
  `LETRA_ITEM` varchar(1) DEFAULT NULL,\
  `NOME_IMAGEM_ITEM_SISTEMA` varchar(100) DEFAULT NULL,\
  `ID_DONO` int(11) DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `tb_lista_grupo`\
--\
\
CREATE TABLE `tb_lista_grupo` (\
`idListaGrupo` int(11) NOT NULL,\
  `idGrupo` int(11) NOT NULL,\
  `idEmpresa` int(11) NOT NULL,\
  `idUsuarioResponsavel` int(11) DEFAULT NULL,\
  `idLista` int(11) NOT NULL,\
  `situacaoAcesso` int(11) NOT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `tb_lista_grupo`\
--\
\
INSERT INTO `tb_lista_grupo` (`idListaGrupo`, `idGrupo`, `idEmpresa`, `idUsuarioResponsavel`, `idLista`, `situacaoAcesso`) VALUES\
(1, 7, 11, NULL, 1, 1),\
(2, 8, 12, NULL, 2, 1),\
(3, 10, 14, NULL, 3, 1);\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `tb_materia`\
--\
\
CREATE TABLE `tb_materia` (\
`ID_MATERIA` int(11) NOT NULL,\
  `NOME_MATERIA` varchar(100) DEFAULT NULL,\
  `ID_DONO` int(11) DEFAULT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `tb_materia`\
--\
\
INSERT INTO `tb_materia` (`ID_MATERIA`, `NOME_MATERIA`, `ID_DONO`) VALUES\
(14, 'Porgugues', 11);\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `tb_questao`\
--\
\
CREATE TABLE `tb_questao` (\
`ID_QUESTAO` int(11) NOT NULL,\
  `ANO_QUESTAO` int(11) DEFAULT NULL,\
  `NUMERO_QUESTAO` int(11) DEFAULT NULL,\
  `DESCRICAO_QUESTAO` varchar(2000) DEFAULT NULL,\
  `COMANDO_QUESTAO` varchar(2000) DEFAULT NULL,\
  `PROVA` int(11) DEFAULT '1',\
  `SITUACAO_QUESTAO` int(11) DEFAULT '1',\
  `NOME_IMAGEM_QUESTAO` varchar(100) DEFAULT '1',\
  `COMENTARIO_QUESTAO` varchar(2000) DEFAULT NULL,\
  `NOME_IMAGEM_QUESTAO_SISTEMA` varchar(200) DEFAULT '1',\
  `LETRA_ITEM_CORRETO` varchar(1) DEFAULT NULL,\
  `DIA_PROVA` int(11) DEFAULT NULL,\
  `APLICACAO` int(11) DEFAULT NULL,\
  `ID_DONO` int(11) NOT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `tb_questao`\
--\
\
INSERT INTO `tb_questao` (`ID_QUESTAO`, `ANO_QUESTAO`, `NUMERO_QUESTAO`, `DESCRICAO_QUESTAO`, `COMANDO_QUESTAO`, `PROVA`, `SITUACAO_QUESTAO`, `NOME_IMAGEM_QUESTAO`, `COMENTARIO_QUESTAO`, `NOME_IMAGEM_QUESTAO_SISTEMA`, `LETRA_ITEM_CORRETO`, `DIA_PROVA`, `APLICACAO`, `ID_DONO`) VALUES\
(1, 2016, 12, 'Questao escola 11', 'Quest\'e3o escola 11', 1, 1, '1', 'teste', '1', 'A', 1, 1, 11),\
(2, 2014, 123, 'questao 12', 'asdfasdf', 1, 1, '1', 'asdfasdf', '1', 'A', 1, 1, 12),\
(3, 2015, 1, 'questao prof fulano', 'prof fulano', 1, 1, '1', 'prof fulano', '1', 'A', 1, 1, 14),\
(4, 2014, 123, 'afasdfadf', 'adfasdf', 1, 1, '1', 'asdf', '1', 'A', 1, 1, 14);\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `tb_questao_habilidades`\
--\
\
CREATE TABLE `tb_questao_habilidades` (\
  `TB_HABILIDADES_ID_HABILIDADE` int(11) NOT NULL,\
  `TB_QUESTAO_ID_QUESTAO` int(11) NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `usuario`\
--\
\
CREATE TABLE `usuario` (\
`id` int(11) NOT NULL,\
  `nome` varchar(255) DEFAULT NULL,\
  `email` varchar(255) DEFAULT NULL,\
  `senha` varchar(255) DEFAULT NULL,\
  `idempresa` int(11) DEFAULT NULL,\
  `dt_criacao_usuario` datetime DEFAULT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `usuario`\
--\
\
INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `idempresa`, `dt_criacao_usuario`) VALUES\
(171, 'bizu', 'rezenderegis@gmail.com', '202cb962ac59075b964b07152d234b70', 0, NULL),\
(172, 'calbi', 'calbi@gmail.com', '202cb962ac59075b964b07152d234b70', 0, NULL),\
(173, 'nova', 'nova_e11@gmail.com', '202cb962ac59075b964b07152d234b70', 11, NULL),\
(174, 'rui', 'rui_e11@gmail.com', NULL, 11, NULL),\
(175, 'joel', 'joel_12@gmail.com', NULL, 12, NULL),\
(176, 'Joao Aluno', 'joaoAluno@gmail.com', '202cb962ac59075b964b07152d234b70', 0, NULL),\
(177, 'professor fulano', 'professorfulano@gmail.com', '202cb962ac59075b964b07152d234b70', 0, NULL),\
(178, 'michele pretinha', 'michelepretinha@gmail.com', '202cb962ac59075b964b07152d234b70', 0, NULL),\
(179, '', 'michelepretinha@gmail.com', NULL, 14, NULL),\
(180, 'julialima', 'julialima@gmail.com', '202cb962ac59075b964b07152d234b70', 0, NULL),\
(181, 'Joao do Lago', 'joaodolago@gmail.com', NULL, 14, NULL),\
(182, 'juliana silva', 'jusilva143@gmail.com', NULL, 14, NULL),\
(183, 'asd', 'mjmjmjvvvvdddd@gmail.com', NULL, 14, NULL);\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `usuario_empresa`\
--\
\
CREATE TABLE `usuario_empresa` (\
  `idusuario` int(11) NOT NULL,\
  `idempresa` int(11) NOT NULL,\
  `loginApp` varchar(1) DEFAULT 'N',\
  `loginSistema` varchar(1) DEFAULT 'N',\
`idusuarioempresa` int(11) NOT NULL,\
  `usuario_master` varchar(1) DEFAULT '0',\
  `perfilAluno` varchar(1) DEFAULT NULL,\
  `perfilProfessor` varchar(1) DEFAULT NULL,\
  `perfilAdministrador` varchar(1) DEFAULT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;\
\
--\
-- Dumping data for table `usuario_empresa`\
--\
\
INSERT INTO `usuario_empresa` (`idusuario`, `idempresa`, `loginApp`, `loginSistema`, `idusuarioempresa`, `usuario_master`, `perfilAluno`, `perfilProfessor`, `perfilAdministrador`) VALUES\
(171, 11, 'N', 'S', 15, 'N', NULL, NULL, NULL),\
(172, 12, 'N', 'S', 16, 'N', NULL, NULL, NULL),\
(171, 12, 'N', 'S', 17, 'N', NULL, NULL, NULL),\
(173, 11, 'N', 'S', 18, 'N', NULL, NULL, NULL),\
(174, 11, 'N', 'N', 19, 'N', NULL, NULL, NULL),\
(175, 12, 'N', 'N', 20, '0', NULL, NULL, NULL),\
(171, 13, 'S', 'S', 21, '0', NULL, NULL, NULL),\
(176, 1, 'N', 'N', 22, '0', NULL, NULL, NULL),\
(177, 14, 'N', 'S', 23, '0', NULL, NULL, NULL),\
(178, 1, 'N', 'N', 24, '0', NULL, NULL, NULL),\
(179, 14, 'N', 'N', 25, '0', NULL, NULL, NULL),\
(180, 1, 'N', 'N', 26, '0', NULL, NULL, NULL),\
(180, 14, 'N', 'N', 27, '0', NULL, NULL, NULL),\
(181, 14, 'N', 'N', 28, '0', NULL, NULL, NULL),\
(182, 14, 'N', 'N', 29, '0', NULL, NULL, NULL),\
(183, 14, 'N', 'N', 30, '0', NULL, NULL, NULL),\
(183, 12, 'N', 'N', 31, '0', NULL, NULL, NULL);\
\
--\
-- Indexes for dumped tables\
--\
\
--\
-- Indexes for table `empresa`\
--\
ALTER TABLE `empresa`\
 ADD PRIMARY KEY (`idempresa`);\
\
--\
-- Indexes for table `lista_questoes`\
--\
ALTER TABLE `lista_questoes`\
 ADD PRIMARY KEY (`idListaQuestoes`);\
\
--\
-- Indexes for table `perfil_descricao`\
--\
ALTER TABLE `perfil_descricao`\
 ADD PRIMARY KEY (`idperfil`);\
\
--\
-- Indexes for table `pessoa`\
--\
ALTER TABLE `pessoa`\
 ADD PRIMARY KEY (`idempresa`,`idpessoa`);\
\
--\
-- Indexes for table `questao_lista`\
--\
ALTER TABLE `questao_lista`\
 ADD PRIMARY KEY (`idListaQuestao`,`idQuestao`);\
\
--\
-- Indexes for table `tb_aluno_grupo`\
--\
ALTER TABLE `tb_aluno_grupo`\
 ADD PRIMARY KEY (`idAlunoGrupo`), ADD KEY `fkUsuario_idx` (`idUsuario`), ADD KEY `fkGrupo_idx` (`idGrupo`);\
\
--\
-- Indexes for table `tb_assunto`\
--\
ALTER TABLE `tb_assunto`\
 ADD PRIMARY KEY (`ID_ASSUNTO`), ADD KEY `fk_TB_ITEM_TB_MATERIA1_idx` (`ID_MATERIA`);\
\
--\
-- Indexes for table `tb_assunto_questao`\
--\
ALTER TABLE `tb_assunto_questao`\
 ADD PRIMARY KEY (`ID_QUESTAO`), ADD KEY `fk_TB_ASSUNTO_MATERIA_TB_ASSUNTO1_idx` (`ID_ASSUNTO`), ADD KEY `fk_TB_ASSUNTO_MATERIA_TB_QUESTAO1_idx` (`ID_QUESTAO`);\
\
--\
-- Indexes for table `tb_competencias`\
--\
ALTER TABLE `tb_competencias`\
 ADD PRIMARY KEY (`ID_COMPETENCIA`);\
\
--\
-- Indexes for table `tb_grupo`\
--\
ALTER TABLE `tb_grupo`\
 ADD PRIMARY KEY (`idGrupo`), ADD KEY `fk_usuario_responsavel_idx` (`responsavelGrupo`);\
\
--\
-- Indexes for table `tb_habilidades`\
--\
ALTER TABLE `tb_habilidades`\
 ADD PRIMARY KEY (`ID_HABILIDADE`), ADD KEY `fk_TB_HABILIDADES_TB_COMPETENCIAS1_idx` (`TB_COMPETENCIAS_ID_COMPETENCIA`);\
\
--\
-- Indexes for table `tb_item`\
--\
ALTER TABLE `tb_item`\
 ADD PRIMARY KEY (`ID_ITEM`), ADD KEY `fk_TB_ITEM_TB_QUESTAO_idx` (`ID_QUESTAO`);\
\
--\
-- Indexes for table `tb_lista_grupo`\
--\
ALTER TABLE `tb_lista_grupo`\
 ADD PRIMARY KEY (`idListaGrupo`), ADD KEY `fk_grupo_idx` (`idGrupo`), ADD KEY `fk_usuario_responsavel_idx` (`idUsuarioResponsavel`);\
\
--\
-- Indexes for table `tb_materia`\
--\
ALTER TABLE `tb_materia`\
 ADD PRIMARY KEY (`ID_MATERIA`);\
\
--\
-- Indexes for table `tb_questao`\
--\
ALTER TABLE `tb_questao`\
 ADD PRIMARY KEY (`ID_QUESTAO`);\
\
--\
-- Indexes for table `tb_questao_habilidades`\
--\
ALTER TABLE `tb_questao_habilidades`\
 ADD KEY `fk_TB_QUESTAO_HABILIDADES_TB_HABILIDADES1_idx` (`TB_HABILIDADES_ID_HABILIDADE`), ADD KEY `fk_TB_QUESTAO_HABILIDADES_TB_QUESTAO1_idx` (`TB_QUESTAO_ID_QUESTAO`);\
\
--\
-- Indexes for table `usuario`\
--\
ALTER TABLE `usuario`\
 ADD PRIMARY KEY (`id`);\
\
--\
-- Indexes for table `usuario_empresa`\
--\
ALTER TABLE `usuario_empresa`\
 ADD PRIMARY KEY (`idusuarioempresa`,`idusuario`,`idempresa`);\
\
--\
-- AUTO_INCREMENT for dumped tables\
--\
\
--\
-- AUTO_INCREMENT for table `empresa`\
--\
ALTER TABLE `empresa`\
MODIFY `idempresa` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;\
--\
-- AUTO_INCREMENT for table `lista_questoes`\
--\
ALTER TABLE `lista_questoes`\
MODIFY `idListaQuestoes` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;\
--\
-- AUTO_INCREMENT for table `tb_aluno_grupo`\
--\
ALTER TABLE `tb_aluno_grupo`\
MODIFY `idAlunoGrupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;\
--\
-- AUTO_INCREMENT for table `tb_assunto`\
--\
ALTER TABLE `tb_assunto`\
MODIFY `ID_ASSUNTO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;\
--\
-- AUTO_INCREMENT for table `tb_grupo`\
--\
ALTER TABLE `tb_grupo`\
MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;\
--\
-- AUTO_INCREMENT for table `tb_habilidades`\
--\
ALTER TABLE `tb_habilidades`\
MODIFY `ID_HABILIDADE` int(11) NOT NULL AUTO_INCREMENT;\
--\
-- AUTO_INCREMENT for table `tb_item`\
--\
ALTER TABLE `tb_item`\
MODIFY `ID_ITEM` int(11) NOT NULL AUTO_INCREMENT;\
--\
-- AUTO_INCREMENT for table `tb_lista_grupo`\
--\
ALTER TABLE `tb_lista_grupo`\
MODIFY `idListaGrupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;\
--\
-- AUTO_INCREMENT for table `tb_materia`\
--\
ALTER TABLE `tb_materia`\
MODIFY `ID_MATERIA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;\
--\
-- AUTO_INCREMENT for table `tb_questao`\
--\
ALTER TABLE `tb_questao`\
MODIFY `ID_QUESTAO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;\
--\
-- AUTO_INCREMENT for table `usuario`\
--\
ALTER TABLE `usuario`\
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=184;\
--\
-- AUTO_INCREMENT for table `usuario_empresa`\
--\
ALTER TABLE `usuario_empresa`\
MODIFY `idusuarioempresa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;\
--\
-- Constraints for dumped tables\
--\
\
--\
-- Constraints for table `tb_aluno_grupo`\
--\
ALTER TABLE `tb_aluno_grupo`\
ADD CONSTRAINT `fkGrupo` FOREIGN KEY (`idGrupo`) REFERENCES `tb_grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,\
ADD CONSTRAINT `fkUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;\
\
--\
-- Constraints for table `tb_assunto`\
--\
ALTER TABLE `tb_assunto`\
ADD CONSTRAINT `fk_TB_ITEM_TB_MATERIA1` FOREIGN KEY (`ID_MATERIA`) REFERENCES `tb_materia` (`ID_MATERIA`) ON DELETE NO ACTION ON UPDATE NO ACTION;\
\
--\
-- Constraints for table `tb_grupo`\
--\
ALTER TABLE `tb_grupo`\
ADD CONSTRAINT `fk_usuario_responsavel` FOREIGN KEY (`responsavelGrupo`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;\
\
--\
-- Constraints for table `tb_lista_grupo`\
--\
ALTER TABLE `tb_lista_grupo`\
ADD CONSTRAINT `fk_grupo` FOREIGN KEY (`idGrupo`) REFERENCES `tb_grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;\
}