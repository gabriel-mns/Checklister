DROP DATABASE IF EXISTS CHECKLISTER;
CREATE DATABASE IF NOT EXISTS  CHECKLISTER;

USE CHECKLISTER;

CREATE TABLE CHECKLIST(
    
    id_checklist int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    data_hora_criacao DATETIME NOT NULL,
    versao_checklist varchar(255) NOT NULL,
    autor_vesao varchar(255) NOT NULL

);

CREATE TABLE AVALIACAO(

    id_avaliacao int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    id_checklist int UNSIGNED NOT NULL,
    data_hora_avaliacao DATETIME,
    versao_artefato varchar(255),
    nome_avaliador varchar(255),

    FOREIGN KEY(id_checklist) REFERENCES CHECKLIST(id_checklist)

);

CREATE TABLE CHECKLIST_ITEM (

    id_checklist_item int unsigned PRIMARY KEY AUTO_INCREMENT,
    id_checklist int UNSIGNED,
    descricao VARCHAR(255) not null,
    nome_responsavel_correcao VARCHAR(255) not null,
    gravidade_nao_conformidade ENUM('Baixa', 'Média', 'Alta'),
    prazo_em_dias int,

    FOREIGN KEY(id_checklist) REFERENCES CHECKLIST(id_checklist)
);

CREATE TABLE AVALIACAO_CHECKLIST_ITEM(

    id_avaliacao int UNSIGNED,
    id_checklist_item int UNSIGNED,
    isConforme boolean DEFAULT null,
    observacao VARCHAR(255),

    PRIMARY KEY (id_avaliacao, id_checklist_item),
    FOREIGN KEY(id_avaliacao) REFERENCES AVALIACAO(id_avaliacao),
    FOREIGN KEY(id_checklist_item) REFERENCES CHECKLIST_ITEM(id_checklist_item)    

);