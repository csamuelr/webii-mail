Use webii;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    sobrenome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(300) NOT NULL,

    PRIMARY key (id)
);

CREATE TABLE email (
    id INT AUTO_INCREMENT,
    remetente INT,
    destinatario INT,
    data timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    assunto VARCHAR(80),
    mensagem VARCHAR(1000),

    PRIMARY KEY (id),
    CONSTRAINT fk_remetente FOREIGN KEY (remetente) REFERENCES usuario(id),
    CONSTRAINT fk_destinatario FOREIGN KEY (destinatario) REFERENCES usuario(id)
);

-- CREATE TABLE enviados (
--     id INT AUTO_INCREMENT,
--     destinatario INT,
--     data DATE,
--     hora TIME,
--     assunto VARCHAR(80),
--     mensagem VARCHAR(1000),

--     PRIMARY KEY (id),
--     CONSTRAINT fk_destinatario FOREIGN KEY (destinatario) REFERENCES usuario(id)
-- );