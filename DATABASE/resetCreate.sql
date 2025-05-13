-- Apaga o banco se já existir
DROP DATABASE IF EXISTS db_dailygreen;

-- Cria o banco novamente
CREATE DATABASE db_dailygreen;
USE db_dailygreen;

CREATE TABLE administrador (
    id_administrador INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_administrador)
);

-- Tabela participante
CREATE TABLE participante (
    id_participante INT NOT NULL AUTO_INCREMENT,
    id_lista INT NOT NULL DEFAULT 1,
    profile_pic VARCHAR(255),
    banner_pic VARCHAR(255),
    biografia VARCHAR(255),
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    genero CHAR(1) NOT NULL,
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_participante),
    CONSTRAINT fk_listaParticipante FOREIGN KEY (id_lista) REFERENCES lista(id_lista)
);

-- Tabela lista
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


-- Atualiza FK da tabela participante
ALTER TABLE participante
    ADD CONSTRAINT fk_listaParticipante FOREIGN KEY (id_lista) REFERENCES lista(id_lista);

-- Tabela organizacao
CREATE TABLE organizacao (
    id_organizacao INT NOT NULL AUTO_INCREMENT,
    id_participante INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    cnpj VARCHAR(18) NOT NULL,
    PRIMARY KEY (id_organizacao),
    FOREIGN KEY (id_participante) REFERENCES participante(id_participante)
);

-- Tabela reacaoPost
CREATE TABLE reacaoPost (
    id_reacaoPost INT NOT NULL AUTO_INCREMENT,
    id_autor_reacao INT NOT NULL,
    tipo_reacao INT NOT NULL,
    PRIMARY KEY (id_reacaoPost),
    FOREIGN KEY (id_autor_reacao) REFERENCES participante(id_participante)
);

-- Tabela post
CREATE TABLE post (
    id_post INT NOT NULL AUTO_INCREMENT,
    id_reacaoPost INT NOT NULL,
    id_autor INT NOT NULL,
    titulo VARCHAR(50) NOT NULL,
    descricao VARCHAR(255),
    PRIMARY KEY (id_post),
    FOREIGN KEY (id_reacaoPost) REFERENCES reacaoPost(id_reacaoPost),
    FOREIGN KEY (id_autor) REFERENCES participante(id_participante)
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

-- Tabela reacaoComentario
CREATE TABLE reacaoComentario (
    id_reacaoComentario INT NOT NULL AUTO_INCREMENT,
    id_autor_reacao INT NOT NULL,
    tipo_reacao INT NOT NULL,
    PRIMARY KEY (id_reacaoComentario),
    FOREIGN KEY (id_autor_reacao) REFERENCES participante(id_participante)
);

-- Tabela comentario
CREATE TABLE comentario (
    id_comentario INT NOT NULL AUTO_INCREMENT,
    id_reacaoComentario INT NOT NULL,
    id_post INT NOT NULL,
    id_autor_comentario INT NOT NULL,
    titulo_comentario VARCHAR(50),
    descricao_comentario VARCHAR(225),
    PRIMARY KEY (id_comentario),
    FOREIGN KEY (id_reacaoComentario) REFERENCES reacaoComentario(id_reacaoComentario),
    FOREIGN KEY (id_post) REFERENCES post(id_post),
    FOREIGN KEY (id_autor_comentario) REFERENCES participante(id_participante)
);

-- Tabela denuncia
CREATE TABLE denuncia (
    id_denuncia INT NOT NULL AUTO_INCREMENT,
    id_relator INT NOT NULL,
    id_relatado INT NOT NULL,
    id_administrador INT NULL,
    titulo VARCHAR(50) NOT NULL,
    motivo VARCHAR(255) NOT NULL,
    status VARCHAR(45) NOT NULL,
    PRIMARY KEY (id_denuncia),
    FOREIGN KEY (id_relator) REFERENCES participante(id_participante),
    FOREIGN KEY (id_relatado) REFERENCES participante(id_participante),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador)
);

-- Tabela banido
CREATE TABLE banido (
    id_banido INT NOT NULL AUTO_INCREMENT,
    id_administrador INT NOT NULL,
    id_participante_banido INT NOT NULL,
    motivo VARCHAR(100) NOT NULL,
    create_time TIMESTAMP NOT NULL,
    PRIMARY KEY (id_banido),
    FOREIGN KEY (id_participante_banido) REFERENCES participante(id_participante),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador)
);

-- Tabela suspenso
CREATE TABLE suspenso (
    id_suspenso INT NOT NULL AUTO_INCREMENT,
    id_administrador INT NOT NULL,
    id_participante_suspenso INT NOT NULL,
    motivo VARCHAR(100) NOT NULL,
    data_hora_inicio DATETIME NOT NULL,
    data_hora_fim DATETIME NOT NULL,
    PRIMARY KEY (id_suspenso),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador),
    FOREIGN KEY (id_participante_suspenso) REFERENCES participante(id_participante)
);