-- Apaga o banco se já existir
DROP DATABASE IF EXISTS db_dailygreen;

-- Cria o banco novamente
CREATE DATABASE db_dailygreen;
USE db_dailygreen;

-- Criação das tabelas

CREATE TABLE administrador (
    id_administrador INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_administrador)
);

CREATE TABLE participante (
    id_participante INT NOT NULL AUTO_INCREMENT,
    profile_pic VARCHAR(255),
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    genero CHAR(1),
    create_time TIMESTAMP NOT NULL,
    PRIMARY KEY (id_participante)
);

CREATE TABLE banido (
    id_banido INT NOT NULL AUTO_INCREMENT,
    id_administrador INT NOT NULL,
    id_participante_banido INT NOT NULL,
    motivo VARCHAR(100),
    create_time TIMESTAMP NOT NULL,
    PRIMARY KEY (id_banido),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador),
    FOREIGN KEY (id_participante_banido) REFERENCES participante(id_participante)
);

CREATE TABLE suspenso (
    id_suspenso INT NOT NULL AUTO_INCREMENT,
    id_administrador INT NOT NULL,
    id_participante_suspenso INT NOT NULL,
    motivo VARCHAR(100),
    data_hora_inicio DATETIME NOT NULL,
    data_hora_fim DATETIME NOT NULL,
    PRIMARY KEY (id_suspenso),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador),
    FOREIGN KEY (id_participante_suspenso) REFERENCES participante(id_participante)
);

CREATE TABLE denuncia (
    id_denuncia INT NOT NULL AUTO_INCREMENT,
    id_relator INT NOT NULL,
    id_relato INT NOT NULL,
    id_administrador INT NOT NULL,
    titulo VARCHAR(50),
    motivo VARCHAR(255),
    status VARCHAR(45),
    PRIMARY KEY (id_denuncia),
    FOREIGN KEY (id_relator) REFERENCES participante(id_participante),
    FOREIGN KEY (id_relato) REFERENCES participante(id_participante),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador)
);

CREATE TABLE organizacao (
    id_organizacao INT NOT NULL AUTO_INCREMENT,
    id_participante INT NOT NULL,
    nome VARCHAR(100),
    cnpj INT NOT NULL,
    PRIMARY KEY (id_organizacao),
    FOREIGN KEY (id_participante) REFERENCES participante(id_participante)
);

CREATE TABLE post (
    id_post INT NOT NULL AUTO_INCREMENT,
    id_autor INT NOT NULL,
    titulo VARCHAR(50),
    descricao VARCHAR(255),
    PRIMARY KEY (id_post),
    FOREIGN KEY (id_autor) REFERENCES participante(id_participante)
);

CREATE TABLE evento (
    id_evento INT NOT NULL AUTO_INCREMENT,
    id_organizacao INT NOT NULL,
    id_post INT NOT NULL,
    data_hora_inicio DATETIME NOT NULL,
    data_hora_fim DATETIME NOT NULL,
    local VARCHAR(255),
    link VARCHAR(255),
    PRIMARY KEY (id_evento),
    FOREIGN KEY (id_organizacao) REFERENCES organizacao(id_organizacao),
    FOREIGN KEY (id_post) REFERENCES post(id_post)
);

CREATE TABLE midia (
    id_midia INT NOT NULL AUTO_INCREMENT,
    id_post INT NOT NULL,
    midia_ref VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_midia),
    FOREIGN KEY (id_post) REFERENCES post(id_post)
);
