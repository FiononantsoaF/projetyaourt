CREATE DATABASE projetYaourt;
USE projetYaourt;

-- Table des centres
CREATE TABLE centre (
    idCentre INT PRIMARY KEY AUTO_INCREMENT,
    nomCentre VARCHAR(100) NOT NULL
);

-- Table des natures
CREATE TABLE nature (
    idNature INT PRIMARY KEY AUTO_INCREMENT,
    nomNature VARCHAR(100) NOT NULL
);

-- Table des types de charges
CREATE TABLE typeCharge (
    idTypeCharge INT PRIMARY KEY AUTO_INCREMENT,
    nomTypeCharge VARCHAR(100) NOT NULL
);

-- Table des oeuvriers
CREATE TABLE oeuvrier (
    idOeuvre INT PRIMARY KEY AUTO_INCREMENT,
    nomOeuvre VARCHAR(100) NOT NULL,
    idCentre INT,
    salaire DECIMAL(10, 2),
    FOREIGN KEY (idCentre) REFERENCES centre(idCentre)
);

-- Table des unités d'oeuvre
CREATE TABLE uniteOeuvre (
    idUnite INT PRIMARY KEY AUTO_INCREMENT,
    nomUnite VARCHAR(100) NOT NULL
);

-- Table des motifs spéciaux
CREATE TABLE motifSpecial (
    idMotif INT PRIMARY KEY AUTO_INCREMENT,
    nomMotif VARCHAR(100) NOT NULL
);

-- Table des charges
CREATE TABLE charge (
    idCharge INT PRIMARY KEY AUTO_INCREMENT,
    nomCharge VARCHAR(100) NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    idUnite INT,
    idNature INT,
    idMotif INT,
    FOREIGN KEY (idUnite) REFERENCES uniteOeuvre(idUnite),
    FOREIGN KEY (idNature) REFERENCES nature(idNature),
    FOREIGN KEY (idMotif) REFERENCES motifSpecial(idMotif)
);
