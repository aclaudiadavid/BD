drop table LocalPublico cascade;
drop table Item cascade;
drop table Anomalia cascade;
drop table AnomaliaTraducao cascade;
drop table Duplicado cascade;
drop table Utilizador cascade;
drop table UtilizadorQualificado cascade;
drop table UtilizadorRegular cascade;
drop table Incidencia cascade;
drop table PropostaCorrecao cascade;
drop table Correcao cascade;

-- Criar tabelas
CREATE TABLE LocalPublico (
    latitude DECIMAL(8,6) NOT NULL,
    longitude DECIMAL(9,6) NOT NULL,
    nome VARCHAR(200),
    CONSTRAINT pk_LocalPublico PRIMARY KEY(latitude, longitude)
);

CREATE TABLE Item (
    idItem INTEGER NOT NULL UNIQUE,
    latitude DECIMAL(8,6),
    longitude DECIMAL(9,6),
    descricaoItem TEXT,
    localizacao VARCHAR(255),
    CONSTRAINT pk_Item PRIMARY KEY(idItem),
    CONSTRAINT fk_coordLocalPublico FOREIGN KEY(latitude, longitude) REFERENCES LocalPublico(latitude, longitude) ON DELETE CASCADE
);

CREATE TABLE Anomalia (
    idAnomalia INTEGER NOT NULL UNIQUE,
    zona BOX,
    imagem VARCHAR(2083),
    lingua CHAR(3),
    ts TIMESTAMP,
    descricaoAnom TEXT,
    temAnomaliaRedacao BIT,

    CONSTRAINT pk_Anomalia PRIMARY KEY(idAnomalia)
);

CREATE TABLE AnomaliaTraducao (
    idAnomaliaTraducao INTEGER NOT NULL UNIQUE,
    zona2 BOX,
    lingua2 CHAR(3),
    CONSTRAINT pk_AnomaliaTraducao PRIMARY KEY(idAnomaliaTraducao),
    CONSTRAINT fk_idAnomalia FOREIGN KEY(idAnomaliaTraducao) REFERENCES Anomalia(idAnomalia) ON DELETE CASCADE
);

CREATE TABLE Duplicado (
    idItem1 INTEGER,
    idItem2 INTEGER,
    
    CONSTRAINT chk_items CHECK (idItem1 != idItem2),
    CONSTRAINT pk_Duplicado PRIMARY KEY(idItem1, idItem2),
    CONSTRAINT fk_Duplicado1 FOREIGN KEY(idItem1) REFERENCES Item(idItem) ON DELETE CASCADE,
    CONSTRAINT fk_Duplicado2 FOREIGN KEY(idItem2) REFERENCES Item(idItem) ON DELETE CASCADE
);

CREATE TABLE Utilizador (
    email VARCHAR(254) NOT NULL UNIQUE,
    password VARCHAR(255),
    CONSTRAINT pk_Utilizador PRIMARY KEY(email)
);

CREATE TABLE UtilizadorQualificado (
    email VARCHAR(254),
    CONSTRAINT pk_UtilizadorQualificado PRIMARY KEY(email),
    CONSTRAINT fk_email FOREIGN KEY(email) REFERENCES Utilizador(email) ON DELETE CASCADE
);

CREATE TABLE UtilizadorRegular (
    email VARCHAR(254),
    CONSTRAINT pk_UtilizadorRegular PRIMARY KEY(email),
    CONSTRAINT fk_email FOREIGN KEY(email) REFERENCES Utilizador(email) ON DELETE CASCADE
);

CREATE TABLE Incidencia (
    idAnomalia INTEGER,
    idItem INTEGER,
    email VARCHAR(254),
    CONSTRAINT pk_Incidencia PRIMARY KEY(idAnomalia),
    CONSTRAINT fk_idAnomalia FOREIGN KEY(idAnomalia) REFERENCES Anomalia(idAnomalia) ON DELETE CASCADE,
    CONSTRAINT fk_idItem FOREIGN KEY(idItem) REFERENCES Item(idItem) ON DELETE CASCADE,
    CONSTRAINT fk_email FOREIGN KEY(email) REFERENCES Utilizador(email) ON DELETE CASCADE
);

CREATE TABLE PropostaCorrecao (
    email VARCHAR(254),
    nro INTEGER,
    data_hora TIMESTAMP,
    texto TEXT,
    CONSTRAINT pk_PropostaCorrecao PRIMARY KEY(email, nro),
    CONSTRAINT fk_email FOREIGN KEY(email) REFERENCES UtilizadorQualificado(email) ON DELETE CASCADE
);

CREATE TABLE Correcao (
    email VARCHAR(254),
    nro INTEGER,
    idAnomalia INTEGER,
    CONSTRAINT pk_Correcao PRIMARY KEY(email, nro, idAnomalia),
    CONSTRAINT fk_propostaCorecao FOREIGN KEY(email, nro) REFERENCES PropostaCorrecao(email, nro) ON DELETE CASCADE,
    CONSTRAINT fk_idAnomalia FOREIGN KEY(idAnomalia) REFERENCES Incidencia(idAnomalia) ON DELETE CASCADE
);