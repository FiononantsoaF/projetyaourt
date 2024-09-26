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
    idCentre INT NOT NULL,
    salaire DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    FOREIGN KEY (idCentre) REFERENCES centre(idCentre) 
);

-- Table des unités d'oeuvre
CREATE TABLE uniteOeuvre (
    idUnite INT PRIMARY KEY AUTO_INCREMENT,
    nomUnite VARCHAR(100) NOT NULL
);

-- Table des motifs non incorporés
CREATE TABLE nonIncorp (
    idMotif INT PRIMARY KEY AUTO_INCREMENT,
    nomMotif VARCHAR(100) NOT NULL
);

-- Table des charges supplétives
CREATE TABLE suppletive (
    idSupp INT PRIMARY KEY AUTO_INCREMENT,
    nomSupp VARCHAR(100) NOT NULL
);

-- Table des charges générales
CREATE TABLE chargeGeneral (
    idCharge INT PRIMARY KEY AUTO_INCREMENT,
    nomCharge VARCHAR(100) NOT NULL,
    montant DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    daty DATE NOT NULL
);

-- Table de répartition des charges par centre
CREATE TABLE repartition (
    idRepartition INT PRIMARY KEY AUTO_INCREMENT,
    idGeneral INT NOT NULL,
    idCentre INT NOT NULL,
    pourcentage DECIMAL(5, 2) NOT NULL CHECK (pourcentage >= 0 AND pourcentage <= 100),
    FOREIGN KEY (idGeneral) REFERENCES chargeGeneral(idCharge),
    FOREIGN KEY (idCentre) REFERENCES centre(idCentre)
);

-- Table des charges supplétives
CREATE TABLE chargeSupp (
    idCharge INT PRIMARY KEY AUTO_INCREMENT,
    nomCharge VARCHAR(100) NOT NULL,
    idSupp INT NOT NULL,
    montant DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    daty DATE NOT NULL,
    FOREIGN KEY (idSupp) REFERENCES suppletive(idSupp)
);
