-- Insertion des centres
INSERT INTO centre (nomCentre) 
VALUES 
    ('Production'),
    ('Conditionnement'),
    ('Distribution & Logistique'),
    ('Administration');

-- Insertion des natures
INSERT INTO nature (nomNature) 
VALUES 
    ('Fixe'),
    ('Variable');

-- Insertion des types de charges
INSERT INTO typeCharge (nomTypeCharge) 
VALUES 
    ('Incorporable'),
    ('Non Incorporable'),
    ('Supplétive');

-- Insertion des unités d'oeuvre
INSERT INTO uniteOeuvre (nomUnite) 
VALUES 
    ('Jour'),
    ('Heure'),
    ('Mois'),
    ('Litre'),
    ('Gramme'),
    ('Kilogramme'),
    ('Pièce');

-- Insertion des motifs spéciaux
INSERT INTO motifSpecial (nomMotif) 
VALUES 
    ('Pénalité'),
    ('Amende'),
    ('Dons');
