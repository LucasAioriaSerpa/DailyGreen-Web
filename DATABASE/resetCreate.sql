-- Apaga o banco se já existir
DROP DATABASE IF EXISTS db_dailygreen;

-- Cria o banco novamente
CREATE DATABASE db_dailygreen;
USE db_dailygreen;

-- Tabela lista
CREATE TABLE IF NOT EXISTS lista (
    id_lista INT NOT NULL AUTO_INCREMENT,
    tipo_lista VARCHAR(20),
    PRIMARY KEY (id_lista)
);

INSERT INTO lista (tipo_lista)
VALUES ("blackList");

INSERT INTO lista (tipo_lista)
VALUES ("grayList");

INSERT INTO lista (tipo_lista)
VALUES ("whiteList");

-- Tabela participante
CREATE TABLE participante (
    id_participante INT NOT NULL AUTO_INCREMENT,
    id_lista INT NOT NULL DEFAULT 3,
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

-- Tabela organizacao
CREATE TABLE organizacao (
    id_organizacao INT NOT NULL AUTO_INCREMENT,
    id_participante INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    cnpj VARCHAR(18) NOT NULL,
    PRIMARY KEY (id_organizacao),
    FOREIGN KEY (id_participante) REFERENCES participante(id_participante)
);

-- Tabela post
CREATE TABLE IF NOT EXISTS post (
    id_post INT NOT NULL AUTO_INCREMENT,
    id_autor INT NOT NULL,
    titulo VARCHAR(50) NOT NULL,
    descricao VARCHAR(255),
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_post),
    CONSTRAINT fk_participantePost FOREIGN KEY (id_autor) REFERENCES participante (id_participante)
);

-- Tabela reacaoPost
CREATE TABLE IF NOT EXISTS reacaoPost (
    id_reacao INT NOT NULL AUTO_INCREMENT,
    id_reacaoPost INT NOT NULL,
    id_autor_reacao INT NOT NULL,
    reaction VARCHAR(10) NOT NULL,
    PRIMARY KEY (id_reacao),
    CONSTRAINT fk_postReacao FOREIGN KEY (id_reacaoPost) REFERENCES post(id_post),
    CONSTRAINT fk_autorReacaoPost FOREIGN KEY (id_autor_reacao) REFERENCES participante(id_participante)
);

-- Tabela midia
CREATE TABLE midia (
    id_midia INT NOT NULL AUTO_INCREMENT,
    id_post INT NOT NULL,
    midia_ref VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_midia),
    FOREIGN KEY (id_post) REFERENCES post(id_post)
);

-- Tabela evento
CREATE TABLE evento (
    id_evento INT NOT NULL AUTO_INCREMENT,
    id_organizacao INT NOT NULL,
    id_post INT NOT NULL,
    data_hora_inicio DATETIME NOT NULL,
    data_hora_fim DATETIME NOT NULL,
    local VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_evento),
    FOREIGN KEY (id_organizacao) REFERENCES organizacao(id_organizacao),
    FOREIGN KEY (id_post) REFERENCES post(id_post)
);

-- Tabela checklist
CREATE TABLE IF NOT EXISTS checklist (
    id_checklist INT NOT NULL AUTO_INCREMENT,
    id_participante INT NOT NULL,
    id_post INT NOT NULL,
    presente BOOLEAN NOT NULL,
    PRIMARY KEY (id_checklist),
    CONSTRAINT fk_participanteChecklist FOREIGN KEY (id_participante) REFERENCES participante(id_participante),
    CONSTRAINT fk_postChecklist FOREIGN KEY (id_post) REFERENCES post(id_post)
);

-- Tabela comentario
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

-- Tabela reacaoComentario
CREATE TABLE IF NOT EXISTS reacaoComentario (
    id_reacao INT NOT NULL AUTO_INCREMENT,
    id_reacaoComentario INT NOT NULL,
    id_autor_reacao INT NOT NULL,
    reaction VARCHAR(10) NOT NULL,
    PRIMARY KEY (id_reacao),
    CONSTRAINT fk_comentarioReacao FOREIGN KEY (id_reacaoComentario) REFERENCES comentario(id_comentario),
    CONSTRAINT fk_autorReacaoComentario FOREIGN KEY (id_autor_reacao) REFERENCES participante(id_participante)
);

CREATE TABLE administrador (
    id_administrador INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_administrador)
);

-- Tabela denuncia
CREATE TABLE denuncia (
    id_denuncia INT NOT NULL AUTO_INCREMENT,
    id_relator INT NOT NULL,
    id_relatado INT NOT NULL,
    id_administrador INT NULL,
    id_post INT NULL,
    titulo VARCHAR(50) NOT NULL,
    motivo VARCHAR(255) NOT NULL,
    status VARCHAR(45) NOT NULL DEFAULT 'Pendente',
    data_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    data_inicio_analise TIMESTAMP NULL DEFAULT NULL,
    data_fim_analise TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id_denuncia),
    FOREIGN KEY (id_relator) REFERENCES participante(id_participante),
    FOREIGN KEY (id_relatado) REFERENCES participante(id_participante),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador),
    FOREIGN KEY (id_post) REFERENCES post(id_post)
);

-- Tabela banido
CREATE TABLE banido (
    id_banido INT NOT NULL AUTO_INCREMENT,
    id_administrador INT NOT NULL,
    id_participante_banido INT NOT NULL,
    id_denuncia INT NOT NULL,
    motivo VARCHAR(100) NOT NULL,
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_banido),
    FOREIGN KEY (id_participante_banido) REFERENCES participante(id_participante),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador),
    FOREIGN KEY (id_denuncia) REFERENCES denuncia(id_denuncia)
);

-- Tabela suspenso
CREATE TABLE suspenso (
    id_suspenso INT NOT NULL AUTO_INCREMENT,
    id_administrador INT NOT NULL,
    id_participante_suspenso INT NOT NULL,
    id_denuncia INT NOT NULL,
    motivo VARCHAR(100) NOT NULL,
    data_hora_inicio DATETIME NOT NULL,
    data_hora_fim DATETIME NOT NULL,
    PRIMARY KEY (id_suspenso),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador),
    FOREIGN KEY (id_participante_suspenso) REFERENCES participante(id_participante),
    FOREIGN KEY (id_denuncia) REFERENCES denuncia(id_denuncia)
);
