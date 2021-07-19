-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Maio-2021 às 03:07
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `eshop`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `idProduto` int(11) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `idProduto`, `idCliente`) VALUES
(38, 12, 2),
(39, 15, 6),
(42, 17, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(200) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `descricao`) VALUES
(9, 'Tênis', 'Tênis Exclusivos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefone` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(200) NOT NULL,
  `cep` varchar(200) NOT NULL,
  `bairro` varchar(200) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `estado` varchar(200) NOT NULL,
  `isadmin` int(11) NOT NULL DEFAULT 0,
  `genero` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `telefone`, `senha`, `endereco`, `numero`, `complemento`, `cep`, `bairro`, `cidade`, `estado`, `isadmin`, `genero`, `created_at`) VALUES
(2, 'Rafael Silva', 'rafael065@hotmail.com', '22 91111-0000', '123', '', 0, '', '', '', '', '', 0, NULL, NULL),
(3, 'Luis Santos', 'luiz2018@hotmail.com', '(21) 90000-1111', '123', 'Rua da minha cas', 33, 'Casa 10', '22775240', 'Barra', 'Rio de janeiro - RJ', 'Rio de janeiro', 0, NULL, NULL),
(4, 'Guilherme Medeiros', 'luto.beibe@gmail.com', '992725796', '12345', 'Rua tal', 363, '', '09370350', 'Bairro tal', 'Maua', 'São paulo', 1, NULL, NULL),
(5, 'Maria Silva ', 'mariasilva@gmail.com', '(11) 93583-23', '123', '', 0, '', '09320-305', 'Vila Vitória', 'Mauá', 'São Paulo', 0, 'feminino', NULL),
(6, 'Felipe Pinto', 'felipepinto@gmail.com', '(11) 93482-49', '123', '', 0, '', '09320-305', 'Vila Vitória', 'Mauá', 'São Paulo', 0, 'masculino', '2021-05-19 22:52:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_comprador` int(11) DEFAULT NULL,
  `id_fatura` int(11) NOT NULL,
  `nome_produto` varchar(200) NOT NULL,
  `data_compra` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `detalhes` text NOT NULL,
  `external_reference` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `compras`
--

INSERT INTO `compras` (`id`, `id_comprador`, `id_fatura`, `nome_produto`, `data_compra`, `status`, `detalhes`, `external_reference`) VALUES
(11, 3, 12, 'BOLA LIGA DOS CAMPEÃ•ES DA UFA', '22/06/2019', 0, '', 'ID: 26633'),
(16, 4, 17, 'Tênis Nike Air Max Genome Masculino', '03/05/2021', 0, '', 'ID: 39864'),
(17, 4, 18, 'Tênis Nike Air Max Genome Masculino', '03/05/2021', 0, '', 'ID: 36169'),
(18, 4, 19, 'Tênis Nike Air Max Genome Masculino', '03/05/2021', 0, '', 'ID: 12728'),
(19, 4, 20, 'Tênis Nike Air Max Genome Masculino', '03/05/2021', 0, '', 'ID: 56388'),
(20, 4, 21, 'Tênis Nike PG 5 Unissex', '03/05/2021', 0, '', 'ID: 55861');

-- --------------------------------------------------------

--
-- Estrutura da tabela `faturas`
--

CREATE TABLE `faturas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `preco` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `data` varchar(200) NOT NULL,
  `data_vencimento` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `faturas`
--

INSERT INTO `faturas` (`id`, `id_cliente`, `preco`, `status`, `data`, `data_vencimento`) VALUES
(12, 3, '1,99', 1, '22/06/2019', '27/06/2019'),
(17, 4, '999,99', 0, '03/05/2021', '08/05/2021'),
(18, 4, '999,99', 0, '03/05/2021', '08/05/2021'),
(19, 4, '999,99', 0, '03/05/2021', '08/05/2021'),
(20, 4, '999,99', 0, '03/05/2021', '08/05/2021'),
(21, 4, '749,99', 0, '03/05/2021', '08/05/2021');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `tipo_fatura` int(11) NOT NULL,
  `estoque` int(11) NOT NULL,
  `preco` varchar(200) NOT NULL,
  `categoria` varchar(200) NOT NULL,
  `detalhes` text NOT NULL,
  `idVendedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `foto`, `tipo_fatura`, `estoque`, `preco`, `categoria`, `detalhes`, `idVendedor`) VALUES
(12, 'Tênis Nike Air Max Genome Masculino', 'images/uploads/tenis-nike-air-max-genome-masculino-CW1648-004-1.jpg', 0, 46, '999,99', '10', 'Inspirado no visual do início dos anos 2000, o Air Max Genome reformula casa do Air Max. Seu cabedal tecnológico apresenta uma mistura de materiais, incluindo camadas sem costura, mesh arejado e detalhes em TPU durável. A unidade Air em toda a extensão, de baixo perfil acrescenta conforto para combinar com seu design elegante que com certeza se tornará seu novo Air Max favorito.', NULL),
(13, 'Tênis Nike Air Zoom Pegasus 38 Masculino', 'images/uploads/tenis-nike-air-zoom-pegasus-38-masculino-CW7356-003-1.jpg', 0, 100, '699,99', '10', 'Seu cavalo de batalha alado está de volta. O Nike Air Zoom Pegasus 38 continua a oferecer elasticidade à sua passada, utilizando a mesma espuma ágil que seu antecessor. A tela ventilada na parte de cima combina o conforto e a durabilidade que você deseja com um ajuste mais amplo na ponta.', NULL),
(14, 'Tênis Nike PG 5 Unissex', 'images/uploads/tenis-nike-pg-5-unissex-CW3143-400-1.jpg', 0, 59, '749,99', '10', 'Paul George tem um jogo estável e confiável sem esforço. Ele leva seu tempo, mas está sempre bem posicionado para fazer o passe extra, cortar a pista ou dar um salto. Uma evolução mais leve do 4, o PG 5 combina o perfil cano baixo ágil que o Paul gosta com amortecimento Nike Air Strobel flexível em toda a extensão. A unidade Air é costurada diretamente ao cabedal, ajudando a tornar todo o tênis mais leve e trazendo o amortecimento macio e flexível diretamente embaixo do pé—perfeito para manter PG andando com conforto.', NULL),
(15, 'Tênis NikeCourt Air Vapor Pro Masculino', 'images/uploads/tenis-nikecourt-air-vapor-pro-masculino-CZ0220-124-1.jpg', 0, 10, '899,99', '10', 'O NikeCourt Air Zoom Vapor Pro pega tudo o que você adora no NikeCourt Air Zoom Vapor X e o torna mais leve e com mais suporte. O modelo com 3 camadas coloca respirabilidade, estabilidade e durabilidade onde você mais precisa, tudo isso enquanto mantém o mínimo de peso.', NULL),
(16, 'Tênis Jordan MA2 Masculino', 'images/uploads/tenis-jordan-ma2-masculino-CV8122-006-1.jpg', 0, 12, '849,99', '10', 'Desafie o status quo com o Jordan MA2. Fabricado com uma mistura de suede, couro de grão integral e uma variedade de tecidos, o tênis apresenta etiquetas despojadas, estampas tecnológicas e espuma com arestas cruas para oferecer um equilíbrio entre o novo e o clássico. Fáceis de calçar e descalçar e naturalmente confortáveis, os tênis são um símbolo da elegância, atitude e inovação do Jordan.', NULL),
(17, 'Tênis Nike Air Max 95 Masculino', 'images/uploads/tenis-nike-air-max-95-masculino-CZ0191-001-1.jpg', 0, 5, '999,99', '10', 'Inspirado no corpo humano e no DNA da corrida, o Nike Air Max 95 combina conforto inacreditável com estilo impressionante. Os icônicos painéis laterais representam força com cores vibrantes, enquanto o Nike Air visível no calcanhar e no antepé amortece cada passo.', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtosfavoritos`
--

CREATE TABLE `produtosfavoritos` (
  `id` int(11) NOT NULL,
  `idProduto` int(11) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtosfavoritos`
--

INSERT INTO `produtosfavoritos` (`id`, `idProduto`, `idCliente`) VALUES
(4, 17, 2),
(5, 12, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `subcategoria` varchar(200) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `id_categoria`, `subcategoria`, `descricao`) VALUES
(10, 9, 'Nike', 'Tênis Nike exclusivos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `bio` varchar(300) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `genero` varchar(30) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `cep` varchar(30) DEFAULT NULL,
  `estado` varchar(40) DEFAULT NULL,
  `cidade` varchar(40) DEFAULT NULL,
  `bairro` varchar(40) DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ProdutoCarrinho` (`idProduto`),
  ADD KEY `fk_ClienteCarrinho` (`idCliente`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ClientesCompras` (`id_comprador`),
  ADD KEY `fk_FaturasCompras` (`id_fatura`);

--
-- Índices para tabela `faturas`
--
ALTER TABLE `faturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ClientesFaturas` (`id_cliente`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_VendedorProduto` (`idVendedor`);

--
-- Índices para tabela `produtosfavoritos`
--
ALTER TABLE `produtosfavoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ProdutoProdutosFavoritos` (`idProduto`),
  ADD KEY `fk_ClienteProdutosFavoritos` (`idCliente`);

--
-- Índices para tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_SubcategoriasCategorias` (`id_categoria`);

--
-- Índices para tabela `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `faturas`
--
ALTER TABLE `faturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `produtosfavoritos`
--
ALTER TABLE `produtosfavoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `fk_ClienteCarrinho` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_ProdutoCarrinho` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_ClientesCompras` FOREIGN KEY (`id_comprador`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_FaturasCompras` FOREIGN KEY (`id_fatura`) REFERENCES `faturas` (`id`);

--
-- Limitadores para a tabela `faturas`
--
ALTER TABLE `faturas`
  ADD CONSTRAINT `fk_ClientesFaturas` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_VendedorProduto` FOREIGN KEY (`idVendedor`) REFERENCES `vendedores` (`id`);

--
-- Limitadores para a tabela `produtosfavoritos`
--
ALTER TABLE `produtosfavoritos`
  ADD CONSTRAINT `fk_ClienteProdutosFavoritos` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_ProdutoProdutosFavoritos` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_SubcategoriasCategorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
