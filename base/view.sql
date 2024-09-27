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