<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coûts de Production</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>"> <!-- Votre fichier CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1, h2 {
            color: #5a2e91;
            margin-bottom: 10px;
        }
        h1 {
            font-size: 2.5em;
            text-align: center;
        }
        h2 {
            font-size: 1.5em;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #5a2e91;
            color: #ffffff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #d6d6d6;
        }
        td {
            color: #333;
        }
    </style>
</head>
<body>

    <h1>Coûts de Production</h1>

    <h2>Coût par Centre</h2>
    <table>
        <tr>
            <th>Nom du Centre</th>
            <th>Somme</th>
            <th>Pourcentage</th>
            <th>Somme Admin</th>
            <th>Coût Total</th>
        </tr>
        <?php foreach ($coutCentre as $centre): ?>
            <tr>
                <td><?php echo $centre['nomCentre']; ?></td>
                <td><?php echo number_format($centre['somme'], 2, ',', ' '); ?></td>
                <td><?php echo $centre['pourcentage'] == '-' ? '-' : number_format($centre['pourcentage'], 2, ',', ' ') . '%'; ?></td>
                <td><?php echo number_format($centre['sommeAdmin'], 2, ',', ' '); ?></td>
                <td><?php echo number_format($centre['coutTotal'], 2, ',', ' '); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Coût par Litre de Lait</h2>
    <table>
        <tr>
            <th>Unité d'œuvre</th>
            <th>Nombre</th>
            <th>Coût de production</th>
            <th>Coût 1L de yaourt</th>
        </tr>
        <tr>
            <td><?php echo $coutLitre['Unite d\'oeuvre']; ?></td>
            <td><?php echo $coutLitre['nombre']; ?></td>
            <td><?php echo number_format($coutLitre['cout production'], 2, ',', ' '); ?></td>
            <td><?php echo number_format($coutLitre['cout 1l de yaourt'], 2, ',', ' '); ?></td>
        </tr>
    </table>

    <h2>Coût par Boîte de Yaourt</h2>
    <table>
        <tr>
            <th>Unité d'œuvre</th>
            <th>Nombre</th>
            <th>Coût de Production</th>
            <th>Coût de Conditionnement</th>
            <th>Coût de Distribution & Logistique</th>
            <th>Coûts Totaux</th>
            <th>Coût 1 Boîte de Yaourt</th>
        </tr>
        <tr>
            <td><?php echo $coutBoite['unite d\'oeuvre']; ?></td>
            <td><?php echo $coutBoite['nombre']; ?></td>
            <td><?php echo number_format($coutBoite['Production'], 2, ',', ' '); ?></td>
            <td><?php echo number_format($coutBoite['Conditionnement'], 2, ',', ' '); ?></td>
            <td><?php echo number_format($coutBoite['Distribution & Logistique'], 2, ',', ' '); ?></td>
            <td><?php echo number_format($coutBoite['couts totaux'], 2, ',', ' '); ?></td>
            <td><?php echo number_format($coutBoite['1 boîte d\'yaourt'], 2, ',', ' '); ?></td>
        </tr>
    </table>

</body>
</html>