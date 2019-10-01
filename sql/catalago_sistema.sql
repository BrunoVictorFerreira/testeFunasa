USE funasa;

/*
cria a tabela de catalago de sistema
tipoArea: F = FIM, M = MEIO, C = CONTROLE
situacao: P = PRODUÇÃO, D = DESENVOLVIMENTO, N = NOVA VERSÃO, DC = DESCONTINUADO, C = SÓ CONSULTA
disponibilidade = 24X7 = 24H POR 7 DIAS
bd: O = ORACLE, I = INTERBASE, P = POSTGREE, A = ACESS, M = MYSQL
desenv: P = PRÓPRIO, TI = TERCEIRO INTERNO, TE = TERCEIRO EXTERNO GOVERNO, PM = PRODUTO DO MERCADO
cadastro: EA = EXCLUSIVO DO APLICATIVO, ELDAP = USUARIO DO WINDOWS, C = COMPARTILHADO, CSPU, SCA
autenti: LA = LOGIN NA APLICAÇÃO, LR = LOGIN REDE, SSO = SINGLE SIGN ON
plataforma: AM =  ALTA/MAINFRAME, CS = CLIENTE-SERVIDOR, S = SERVE/STORANGE, M = MOBILE, SA = STAND ALONE, W = WEB
pubAlvo = I = INTERNO, OPE = ORGÃO PÚBLICO EXTERNO, C = COVENENTE, PC = POPULA/CIDADÃO, SE = SIST ESTRUTURANTE, OC = ORGÃO CONTROLE
acesso = RI = REDEINTERNA, IE = INTERNET, IA = INTRANET, M = MOBILE
sigilo = S = SIGILOSO, P = PÚBLICO, H = HÍBRIDO
atenti = SS = SENHA SIMPLES, SF = SENHA FORTE, C = CERTIFICADO DIGITAL
*/
CREATE TABLE IF NOT EXISTS `catalago_sistema` (
  `idApli` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(20) NOT NULL,
  `descricao` VARCHAR(500) NOT NULL,
  `finalidade` VARCHAR(500) NOT NULL,
  `tipoArea` ENUM('F', 'M', 'C') NOT NULL,
  `situacao` ENUM('P', 'D', 'N', 'DC', 'C') NOT NULL,
  `disponibilidade` ENUM('24x7') NOT NULL,
  `bd` ENUM('O', 'I', 'P', 'A', 'M') NOT NULL,
  `desenv` ENUM('P', 'TI', 'TE', 'PM') NOT NULL,
  `cadastro` ENUM('EA', 'ELDAP', 'C', 'CSPU', 'SCA') NOT NULL,
  `autenti` ENUM('LA', 'LR', 'SSO') NOT NULL,
  `plataforma` ENUM('AM', 'CS', 'S', 'M', 'SA', 'W') NOT NULL,
  `pubAlvo` ENUM('I', 'OPE', 'C', 'PC', 'SE', 'OC') NOT NULL,
  `acesso` ENUM('RI', 'IE', 'IA', 'M') NOT NULL,
  `acessoDia` VARCHAR(100) NULL,
  `acessoSim` VARCHAR(100) NULL,
  `sigilo` ENUM('S', 'P', 'H') NOT NULL,
  `atenti` ENUM('SS', 'SF', 'C') NOT NULL,
  `enviarDados` VARCHAR(100) NULL,
  `receberDados` VARCHAR(100) NULL,
  `bi` TINYINT NOT NULL DEFAULT 0,
  `observacao` TEXT NULL,
  PRIMARY KEY (`idApli`))
ENGINE = InnoDB default charset = utf8;

/*
cria a tabela de arquitetura
DESKTOP
WEB
MOBILE
*/
CREATE TABLE IF NOT EXISTS `arquitetura` (
  `id` INT NOT NULL,
  `tipo` VARCHAR(45) NOT NULL COMMENT 'D = Web, D = Desktop, M = Mobile',
  PRIMARY KEY (`id`))
ENGINE = InnoDB default charset = utf8;

/*
cria a tabela de linguagem de programação
JAVA
ASP
DELPHI
PHP
ORACLE
BPM
*/
CREATE TABLE IF NOT EXISTS `ligua` (
  `id` INT NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB default charset = utf8;

/*
cria a tabela de impacto
FUNCIONAL
IMAGEM
FINACEIRO
LEGAL
CIDADÃO
*/
CREATE TABLE IF NOT EXISTS `impacto` (
  `id` INT NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB default charset = utf8;

/*
relacionamento da tabela de arquitetura e tabela de catalago de sistema
*/
CREATE TABLE IF NOT EXISTS `arquitetura_has_catalago_sistema` (
  `arquitetura_id` INT NOT NULL,
  `catalago_sistema_idApli` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`arquitetura_id`, `catalago_sistema_idApli`),
  INDEX `fk_arquitetura_has_catalago_sistema_catalago_sistema1_idx` (`catalago_sistema_idApli` ASC),
  INDEX `fk_arquitetura_has_catalago_sistema_arquitetura1_idx` (`arquitetura_id` ASC),
  CONSTRAINT `fk_arquitetura_has_catalago_sistema_arquitetura1`
    FOREIGN KEY (`arquitetura_id`)
    REFERENCES `arquitetura` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_arquitetura_has_catalago_sistema_catalago_sistema1`
    FOREIGN KEY (`catalago_sistema_idApli`)
    REFERENCES `catalago_sistema` (`idApli`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

/*
relacionamento da tabela de linguagem de programação com a tabela de catalago de ssitema
*/
CREATE TABLE IF NOT EXISTS `ligua_has_catalago_sistema` (
  `ligua_id` INT NOT NULL,
  `catalago_sistema_idApli` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ligua_id`, `catalago_sistema_idApli`),
  INDEX `fk_ligua_has_catalago_sistema_catalago_sistema1_idx` (`catalago_sistema_idApli` ASC),
  INDEX `fk_ligua_has_catalago_sistema_ligua1_idx` (`ligua_id` ASC),
  CONSTRAINT `fk_ligua_has_catalago_sistema_ligua1`
    FOREIGN KEY (`ligua_id`)
    REFERENCES `ligua` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ligua_has_catalago_sistema_catalago_sistema1`
    FOREIGN KEY (`catalago_sistema_idApli`)
    REFERENCES `catalago_sistema` (`idApli`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

/*
relacionamento da tabela de impacto com a tabela de catalago de sistema
*/
CREATE TABLE IF NOT EXISTS `impacto_has_catalago_sistema` (
  `impacto_id` INT NOT NULL,
  `catalago_sistema_idApli` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`impacto_id`, `catalago_sistema_idApli`),
  INDEX `fk_impacto_has_catalago_sistema_catalago_sistema1_idx` (`catalago_sistema_idApli` ASC),
  INDEX `fk_impacto_has_catalago_sistema_impacto1_idx` (`impacto_id` ASC),
  CONSTRAINT `fk_impacto_has_catalago_sistema_impacto1`
    FOREIGN KEY (`impacto_id`)
    REFERENCES `impacto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_impacto_has_catalago_sistema_catalago_sistema1`
    FOREIGN KEY (`catalago_sistema_idApli`)
    REFERENCES `catalago_sistema` (`idApli`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

/*
cria a tabela de relacionamento com a tabela de unidade
*/
CREATE TABLE IF NOT EXISTS `catalago_sistema_has_unidade` (
  `catalago_sistema_idApli` VARCHAR(45) NOT NULL,
  `unidade_idUnid` INT(11) NOT NULL,
  PRIMARY KEY (`catalago_sistema_idApli`, `unidade_idUnid`),
  INDEX `fk_catalago_sistema_has_unidade_unidade1_idx` (`unidade_idUnid` ASC),
  INDEX `fk_catalago_sistema_has_unidade_catalago_sistema1_idx` (`catalago_sistema_idApli` ASC),
  CONSTRAINT `fk_catalago_sistema_has_unidade_catalago_sistema1`
    FOREIGN KEY (`catalago_sistema_idApli`)
    REFERENCES `catalago_sistema` (`idApli`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_catalago_sistema_has_unidade_unidade1`
    FOREIGN KEY (`unidade_idUnid`)
    REFERENCES `unidade` (`idUnid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


insert into arquitetura(id, tipo) values (1,'DESKTOP'),(2,'WEB'),(3,'MOBILE');

insert into impacto(id, tipo) values (1,'FUNCIONAL'),(2,'IMAGEM'),(3,'FINACEIRO'),(4,'LEGAL'),(5,'CIDADÃO');

insert into ligua(id, tipo) values (1,'JAVA'),(2,'ASP'),(3,'DELPHI'),(4,'PHP'),(5,'ORACLE'),(6,'BPM');
