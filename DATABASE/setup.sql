-- -----------------------------------------------------
-- Schema db_dailygreen
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS db_dailygreen;
USE db_dailygreen;

-- -----------------------------------------------------
-- Tabela db_dailygreen.lista
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS lista (
    id_lista INT NOT NULL AUTO_INCREMENT,
    tipo_lista VARCHAR(20),
    PRIMARY KEY (id_lista),
);

INSERT INTO lista (tipo_lista)
VALUES ("blackList");

INSERT INTO lista (tipo_lista)
VALUES ("grayList");

INSERT INTO lista (tipo_lista)
VALUES ("whiteList");

-- -----------------------------------------------------
-- Tabela db_dailygreen.participante
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS participante (
    id_participante INT NOT NULL AUTO_INCREMENT,
    id_lista INT NOT NULL DEFAULT 1,
    profile_pic VARCHAR(255),
    banner_pic VARCHAR(255),
    biografia VARCHAR(255),
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    genero CHAR(1) NOT NULL,
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_participante),
    CONSTRAINT fk_listaParticipante FOREIGN KEY (id_lista) REFERENCES lista(id_lista)
);


-- -----------------------------------------------------
-- Tabela organizacao
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS organizacao (
    id_organizacao INT NOT NULL AUTO_INCREMENT,
    id_participante INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    cnpj VARCHAR(18) NOT NULL,
    PRIMARY KEY (id_organizacao),
    CONSTRAINT fk_participanteOrganizacao FOREIGN KEY (id_participante) REFERENCES participante(id_participante)
);

-- -----------------------------------------------------
-- Tabela administrador
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS administrador (
    id_administrador INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_administrador)
);

-- -----------------------------------------------------
-- Tabela post
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS post (
    id_post INT NOT NULL AUTO_INCREMENT,
    id_autor INT NOT NULL,
    titulo VARCHAR(50) NOT NULL,
    descricao VARCHAR(255),
    PRIMARY KEY (id_post),
    CONSTRAINT fk_participantePost FOREIGN KEY (id_autor) REFERENCES participante (id_participante)
);

-- -----------------------------------------------------
-- Tabela reacaoPost
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS reacaoPost (
    id_reacaoPost INT NOT NULL,
    id_autor_reacao INT NOT NULL,
    tipo_gostei INT NOT NULL DEFAULT 0,
    tipo_parabens INT NOT NULL DEFAULT 0,
    tipo_apoio INT NOT NULL DEFAULT 0,
    tipo_amei INT NOT NULL DEFAULT 0,
    tipo_genial INT NOT NULL DEFAULT 0,
    tipo_divertido INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id_reacaoPost),
    CONSTRAINT fk_autorReacaoPost FOREIGN KEY (id_autor_reacao) REFERENCES participante(id_participante)
);

-- -----------------------------------------------------
-- Tabela midia
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS midia (
    id_midia INT NOT NULL AUTO_INCREMENT,
    id_post INT NOT NULL,
    midia_ref VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_midia),
    CONSTRAINT fk_postMidia FOREIGN KEY (id_post) REFERENCES post(id_post)
);

-- -----------------------------------------------------
-- Tabela evento
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS evento (
    id_evento INT NOT NULL AUTO_INCREMENT,
    id_organizacao INT NOT NULL,
    id_post INT NOT NULL,
    data_hora_inicio DATETIME NOT NULL,
    data_hora_fim DATETIME NOT NULL,
    local VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_evento),
    CONSTRAINT fk_organizacaoEvento FOREIGN KEY (id_organizacao) REFERENCES organizacao(id_organizacao),
    CONSTRAINT fk_postEvento FOREIGN KEY (id_post) REFERENCES post(id_post)
);

-- -----------------------------------------------------
-- Tabela comentario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS comentario (
    id_comentario INT NOT NULL AUTO_INCREMENT,
    id_post INT NOT NULL,
    id_autor_comentario INT NOT NULL,
    titulo_comentario VARCHAR(50),
    descricao_comentario VARCHAR(225),
    PRIMARY KEY (id_comentario),
    CONSTRAINT fk_postComentario FOREIGN KEY (id_post) REFERENCES post(id_post),
    CONSTRAINT fk_autorComentario FOREIGN KEY (id_autor_comentario) REFERENCES participante(id_participante)
);

-- -----------------------------------------------------
-- Tabela reacaoComentario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS reacaoComentario (
    id_reacaoComentario INT NOT NULL AUTO_INCREMENT,
    id_autor_reacao INT NOT NULL DEFAULT 0,
    tipo_gostei INT NOT NULL DEFAULT 0,
    tipo_parabens INT NOT NULL DEFAULT 0,
    tipo_apoio INT NOT NULL DEFAULT 0,
    tipo_amei INT NOT NULL DEFAULT 0,
    tipo_genial INT NOT NULL DEFAULT 0,
    tipo_divertido INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id_reacaoComentario),
    CONSTRAINT fk_autorReacaoComentario FOREIGN KEY (id_autor_reacao) REFERENCES participante(id_participante)
);

-- -----------------------------------------------------
-- Tabela denuncia
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS denuncia (
    id_denuncia INT NOT NULL AUTO_INCREMENT,
    id_relator INT NOT NULL,
    id_relatado INT NOT NULL,
    id_administrador INT NULL,
    titulo VARCHAR(50) NOT NULL,
    motivo VARCHAR(255) NOT NULL,
    status VARCHAR(45) NOT NULL,
    PRIMARY KEY (id_denuncia),
    CONSTRAINT fk_relatorDenuncia FOREIGN KEY (id_relator) REFERENCES participante (id_participante),
    CONSTRAINT fk_relatadoDenuncia FOREIGN KEY (id_relatado) REFERENCES participante (id_participante),
    CONSTRAINT fk_admDenuncia FOREIGN KEY (id_administrador) REFERENCES administrador (id_administrador)
);

-- -----------------------------------------------------
-- Tabela banido
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS banido (
    id_banido INT NOT NULL AUTO_INCREMENT,
    id_administrador INT NOT NULL,
    id_participante_banido INT NOT NULL,
    motivo VARCHAR(100) NOT NULL,
    create_time TIMESTAMP NOT NULL,
    PRIMARY KEY (id_banido),
    CONSTRAINT fk_participanteBanidio FOREIGN KEY (id_participante_banido) REFERENCES participante (id_participante),
    CONSTRAINT fk_administradorBanido FOREIGN KEY (id_administrador) REFERENCES administrador (id_administrador)
);

-- -----------------------------------------------------
-- Tabela suspenso
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS suspenso (
    id_suspenso INT NOT NULL AUTO_INCREMENT,
    id_administrador INT NOT NULL,
    id_participante_suspenso INT NOT NULL,
    motivo VARCHAR(100) NOT NULL,
    data_hora_inicio DATETIME NOT NULL,
    data_hora_fim DATETIME NOT NULL,
    PRIMARY KEY (id_suspenso),
    CONSTRAINT fk_administradorSuspenso FOREIGN KEY (id_administrador) REFERENCES administrador (id_administrador),
    CONSTRAINT fk_participanteSuspenso FOREIGN KEY (id_participante_suspenso) REFERENCES participante (id_participante)
);