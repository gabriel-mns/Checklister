DROP DATABASE IF EXISTS CHECKLISTER;
CREATE DATABASE IF NOT EXISTS  CHECKLISTER;

USE CHECKLISTER;

CREATE TABLE CHECKLIST(
    
    id_checklist int UNSIGNED AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    data_hora_criacao DATETIME NOT NULL,
    versao_checklist int UNSIGNED, 
    autor_versao varchar(255) NOT NULL,

    PRIMARY KEY (id_checklist, versao_checklist)
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
INSERT INTO checklist (titulo, data_hora_criacao, autor_versao, versao_checklist) 
            VALUES ("Requisitos", "2023-10-17 17:00:33", "Carlos", 1);
INSERT INTO checklist (titulo, data_hora_criacao, autor_versao, versao_checklist) 
            VALUES ("Caso de Uso", "2023-10-31 08:30:13", "Gabriel", 1);


INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (1, "O requisito está especificado de forma completa e possibilita a implementação?", "Gabriel", "Alta", 2 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (1, "O requisito reflete os stakeholders desejam?", "Gabriel", "alta", 1 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (1, "O requisito descreve uma única capacidade, característica, restrição ou atributo de qualidade? ", "Gabriel", "Alta", 2 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (1, "O requisito é viável de acordo com o projeto?", "Gabriel", "Alta", 2 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (1, "O requisito tem um motivo de existir, que é representado pelo seu relacionamento a uma fonte de informação e a um objetivo de negócio?", "Gabriel", "Média", 4 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (1, "O requisito possui prioridade atribuída?", "Gabriel", "Alta", 2 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (1, "O requisito está escrito de forma não ambígua?", "Gabriel", "Alta", 2 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (1, "O requisito é possível ser verificado posteriormente?", "Gabriel", "Alta", 2 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (1, "O requisito está em conforme com os padrões do projeto?", "Gabriel", "Média", 3 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (2, "O caso de uso tem um identificador único e está escrito no infinitivo?", "Guilherme", "Média", 5 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (2, "O ator principal está identificado corretamente?", "Guilherme", "Alta", 2 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (2, "Caso haja, O ator secundário está identificado corretamente e participa do caso de uso juntamente com o ator principal?", "Guilherme", "Alta", 2 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (2, "Todos os passos do fluxo principal estão numerados sequencialmente e descrevem claramente o diálogo entre o ator e o sistema?", "Guilherme", "Alta", 2 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (2, "Todos os fluxos de exceção definem qual é o próximo passo a ser executado ao seu término?", "Guilherme", "Média", 4 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (2, "Para todos os fluxos de exceção estão identificados os pontos de chamada, seja no fluxo básico, seja nos fluxos alternativos?", "Guilherme", "Média", 4 );
INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) 
VALUES (2, "Caso haja, Para todos os fluxos alternativos estão identificados os pontos de chamada no fluxo básico?", "Guilherme", "Baixa", 15 );


INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-05 08:07:10", "1", "Gabriel");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-05 08:30:10", "1", "Gabriel");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-05 09:13:50", "1", "Gabriel");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-05 10:01:00", "1", "Gabriel");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-05 10:59:30", "1", "Gabriel");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (2, "2023-11-07 11:36:25", "1", "Guilherme");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-15 09:30:00", "1", "Gabriel");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (2, "2023-11-15 10:15:20", "1", "Guilherme");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-15 11:20:45", "1", "Gabriel");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (2, "2023-11-15 12:40:30", "1", "Guilherme");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-15 13:55:10", "1", "Gabriel");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (2, "2023-11-15 14:30:55", "1", "Guilherme");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-16 14:31:55", "1", "Gabriel");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-16 15:31:55", "1", "Gabriel");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-16 16:31:55", "1", "Gabriel");
INSERT INTO avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador) 
		VALUES (1, "2023-11-16 16:39:14", "1", "Gabriel");



INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (1, 1, null, "Requisito não está completo");
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (2, 2, true, null);
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (3, 3, null, "Requisito requer mais características únicas, vários se repetem" );
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (4, 4, true, null);
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (5, 5, null, "Muitos requisitos não deveriam existir");
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (6, 6, true, null);
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (7, 7, null, "Requisitos escrito de maneira ambígua" );
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (8, 8, true, null);
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (9, 9, null, "Requisito não haver com o escopo do projeto");
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (10, 10, true, null);
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (11, 11, true, null);
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (12, 12, null, "Difícil distinção entre ator principal e secundário, muitas vezes assumindo mesmos papeis");
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (13, 13, true, null);
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (14, 14, true, null);
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (15, 15, true, null);
INSERT INTO avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao) 
		VALUES (16, 16, true, null);
