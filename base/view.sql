CREATE VIEW vueRepartitionComplete AS
SELECT
    cg.idCharge,
    cg.nomCharge,
    cg.montant,
    cg.daty,
    r.idRepartition,
    c.idCentre,
    c.nomCentre,
    u.idUnite,
    u.nomUnite,
    n.idNature,
    n.nomNature,
    r.pourcentage
FROM
    chargeGeneral cg
JOIN
    repartition r ON cg.idCharge = r.idGeneral
JOIN
    uniteOeuvre u ON r.idUnite = u.idUnite
JOIN
    centre c ON r.idCentre = c.idCentre
JOIN
    nature n ON r.idNature = n.idNature;

CREATE OR REPLACE VIEW vueRepartitionAvecCalculs AS
SELECT
    cg.idCharge,
    cg.nomCharge,
    cg.montant,
    cg.daty,
    r.idRepartition,
    c.idCentre,
    c.nomCentre,
    u.idUnite,
    u.nomUnite,
    n.idNature,
    n.nomNature,
    r.pourcentage,
    CASE WHEN n.nomNature = 'Fixe' THEN (r.pourcentage / 100) * cg.montant ELSE 0 END AS montantFixe,
    CASE WHEN n.nomNature = 'Variable' THEN (r.pourcentage / 100) * cg.montant ELSE 0 END AS montantVariable
FROM
    chargeGeneral cg
JOIN
    repartition r ON cg.idCharge = r.idGeneral
JOIN
    uniteOeuvre u ON r.idUnite = u.idUnite
JOIN
    centre c ON r.idCentre = c.idCentre
JOIN
    nature n ON r.idNature = n.idNature;