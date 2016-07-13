
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- cliente
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `endereco` VARCHAR(45),
    `telefone` VARCHAR(45),
    `email` VARCHAR(45),
    `data_cadastro` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- consumo
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `consumo`;

CREATE TABLE `consumo`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `id_producao` int(10) unsigned NOT NULL,
    `id_produto` int(10) unsigned NOT NULL,
    `quantidade` DECIMAL NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_consumo_producao1_idx` (`id_producao`),
    INDEX `fk_consumo_produto1_idx` (`id_produto`),
    CONSTRAINT `fk_consumo_producao1`
        FOREIGN KEY (`id_producao`)
        REFERENCES `producao` (`id`),
    CONSTRAINT `fk_consumo_produto1`
        FOREIGN KEY (`id_produto`)
        REFERENCES `produto` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ingrediente
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ingrediente`;

CREATE TABLE `ingrediente`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ingrediente_receita
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ingrediente_receita`;

CREATE TABLE `ingrediente_receita`
(
    `id_ingrediente` int(10) unsigned NOT NULL,
    `id_receita` int(10) unsigned NOT NULL,
    `quantidade` DECIMAL NOT NULL,
    `id_unidade` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id_ingrediente`,`id_receita`),
    INDEX `fk_ingrediente_has_receita_receita1_idx` (`id_receita`),
    INDEX `fk_ingrediente_has_receita_ingrediente1_idx` (`id_ingrediente`),
    INDEX `fk_ingrediente_receita_unidade1_idx` (`id_unidade`),
    CONSTRAINT `fk_ingrediente_has_receita_ingrediente1`
        FOREIGN KEY (`id_ingrediente`)
        REFERENCES `ingrediente` (`id`),
    CONSTRAINT `fk_ingrediente_has_receita_receita1`
        FOREIGN KEY (`id_receita`)
        REFERENCES `receita` (`id`),
    CONSTRAINT `fk_ingrediente_receita_unidade1`
        FOREIGN KEY (`id_unidade`)
        REFERENCES `unidade` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- local
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `local`;

CREATE TABLE `local`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- marca
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- pedido
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pedido`;

CREATE TABLE `pedido`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `codigo` VARCHAR(45) NOT NULL,
    `id_cliente` int(10) unsigned NOT NULL,
    `data_pedido` DATETIME NOT NULL,
    `data_entrega` DATETIME,
    `valor_cobrado` DECIMAL NOT NULL,
    `custo` DECIMAL,
    `lucro` DECIMAL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `codigo_UNIQUE` (`codigo`),
    INDEX `fk_pedido_cliente1_idx` (`id_cliente`),
    CONSTRAINT `fk_pedido_cliente1`
        FOREIGN KEY (`id_cliente`)
        REFERENCES `cliente` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- producao
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `producao`;

CREATE TABLE `producao`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `id_pedido` int(10) unsigned NOT NULL,
    `descricao` VARCHAR(45),
    `id_tipo_producao` int(10) unsigned NOT NULL,
    `quantidade_produzida` DECIMAL,
    `data_producao` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_producao_pedido1_idx` (`id_pedido`),
    INDEX `fk_producao_tipo_producao1_idx` (`id_tipo_producao`),
    CONSTRAINT `fk_producao_pedido1`
        FOREIGN KEY (`id_pedido`)
        REFERENCES `pedido` (`id`),
    CONSTRAINT `fk_producao_tipo_producao1`
        FOREIGN KEY (`id_tipo_producao`)
        REFERENCES `tipo_producao` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- produto
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `produto`;

CREATE TABLE `produto`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `id_produto_base` int(10) unsigned NOT NULL,
    `id_local` int(10) unsigned NOT NULL,
    `preco` DECIMAL NOT NULL,
    `data_cadastro` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_produto_produto_base1_idx` (`id_produto_base`),
    INDEX `fk_produto_local1_idx` (`id_local`),
    CONSTRAINT `fk_produto_local1`
        FOREIGN KEY (`id_local`)
        REFERENCES `local` (`id`),
    CONSTRAINT `fk_produto_produto_base1`
        FOREIGN KEY (`id_produto_base`)
        REFERENCES `produto_base` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- produto_base
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `produto_base`;

CREATE TABLE `produto_base`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `id_ingrediente` int(10) unsigned NOT NULL,
    `id_marca` int(10) unsigned NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    `quantidade` DECIMAL NOT NULL,
    `id_unidade` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_produto_base_unidade_idx` (`id_unidade`),
    INDEX `fk_produto_base_ingrediente1_idx` (`id_ingrediente`),
    INDEX `fk_produto_base_marca1_idx` (`id_marca`),
    CONSTRAINT `fk_produto_base_ingrediente1`
        FOREIGN KEY (`id_ingrediente`)
        REFERENCES `ingrediente` (`id`),
    CONSTRAINT `fk_produto_base_marca1`
        FOREIGN KEY (`id_marca`)
        REFERENCES `marca` (`id`),
    CONSTRAINT `fk_produto_base_unidade`
        FOREIGN KEY (`id_unidade`)
        REFERENCES `unidade` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- receita
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `receita`;

CREATE TABLE `receita`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `receita` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tipo_producao
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tipo_producao`;

CREATE TABLE `tipo_producao`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `id_receita` int(10) unsigned,
    `nome` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_tipo_producao_receita1_idx` (`id_receita`),
    CONSTRAINT `fk_tipo_producao_receita1`
        FOREIGN KEY (`id_receita`)
        REFERENCES `receita` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- unidade
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `unidade`;

CREATE TABLE `unidade`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `sigla` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- usuario
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(200) NOT NULL,
    `senha` VARCHAR(250) NOT NULL,
    `data_cadastro` DATETIME NOT NULL,
    `habilitado` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
