<style>
    .table td, .table th {
        white-space: nowrap; 
        overflow: hidden;    
        text-overflow: ellipsis;
        max-width: 150px; 
    }
</style>

<table class="table">
    <tr>
        <th>RUBRIQUES</th>
        <th>TOTAL</th>
        <th>UNITE D'ŒUVRE</th>
        <th>Nature</th> 
        <th colspan="3">Production</th>
        <th colspan="3">Conditionnement</th>
        <th colspan="3">Distribution & Logistique</th>
        <th colspan="3">Administration</th>
        <th colspan="2">Total</th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>%</th>
        <th>FIXE</th>
        <th>VARIABLE</th>
        <th>%</th>
        <th>FIXE</th>
        <th>VARIABLE</th>
        <th>%</th>
        <th>FIXE</th>
        <th>VARIABLE</th>
        <th>%</th>
        <th>FIXE</th>
        <th>VARIABLE</th>
        <th>TotalFixe</th>
        <th>TotalVariable</th>
    </tr>

    <?php foreach ($repartition as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['nomCharge']) ?></td>
            <td><?= number_format($row['montant'], 2, ',', ' ') ?></td>
            <td><?= htmlspecialchars($row['nomUnite']) ?></td>
            <td><?= htmlspecialchars($row['nomNature']) ?></td>
            <td><?= $row['pourcentage1'] ?>%</td>
            <td><?= $row['fixe1'] ? number_format($row['fixe1'], 2, ',', ' ') : '-' ?></td>
            <td><?= $row['variable1'] ? number_format($row['variable1'], 2, ',', ' ') : '-' ?></td>
            <td><?= $row['pourcentage2'] ?>%</td>
            <td><?= $row['fixe2'] ? number_format($row['fixe2'], 2, ',', ' ') : '-' ?></td>
            <td><?= $row['variable2'] ? number_format($row['variable2'], 2, ',', ' ') : '-' ?></td>
            <td><?= $row['pourcentage3'] ?>%</td>
            <td><?= $row['fixe3'] ? number_format($row['fixe3'], 2, ',', ' ') : '-' ?></td>
            <td><?= $row['variable3'] ? number_format($row['variable3'], 2, ',', ' ') : '-' ?></td>
            <td><?= $row['pourcentage4'] ?>%</td>
            <td><?= $row['fixe4'] ? number_format($row['fixe4'], 2, ',', ' ') : '-' ?></td>
            <td><?= $row['variable4'] ? number_format($row['variable4'], 2, ',', ' ') : '-' ?></td>
        </tr>
    <?php endforeach; ?>

    <tr>
        <th>TOTAL</th>
        <th><?= number_format(array_sum(array_column($repartition, 'montant')), 2, ',', ' ') ?></th>
        <th colspan="3"></th>
        <th><?= number_format(array_sum(array_column($repartition, 'fixe1')), 2, ',', ' ') ?></th>
        <th><?= number_format(array_sum(array_column($repartition, 'variable1')), 2, ',', ' ') ?></th>
        <th></th>
        <th><?= number_format(array_sum(array_column($repartition, 'fixe2')), 2, ',', ' ') ?></th>
        <th><?= number_format(array_sum(array_column($repartition, 'variable2')), 2, ',', ' ') ?></th>
        <th></th>
        <th><?= number_format(array_sum(array_column($repartition, 'fixe3')), 2, ',', ' ') ?></th>
        <th><?= number_format(array_sum(array_column($repartition, 'variable3')), 2, ',', ' ') ?></th>
        <th></th>
        <th><?= number_format(array_sum(array_column($repartition, 'fixe4')), 2, ',', ' ') ?></th>
        <th><?= number_format(array_sum(array_column($repartition, 'variable4')), 2, ',', ' ') ?></th>
        <th><?= number_format(array_sum(array_column($repartition, 'totalFixe')), 2, ',', ' ') ?></th>
        <th><?= number_format(array_sum(array_column($repartition, 'totalVariable')), 2, ',', ' ') ?></th>
    </tr>
</table>
