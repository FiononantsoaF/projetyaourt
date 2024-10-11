<main class="container mt-5">
    <h2>Insertion besoins</h2>
    <div class="conteneur">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6 shadow p-4 rounded">
                <form method="post" action="<?php echo base_url('BesoinController/index'); ?>">
                    <div class="mb-3">
                        <label for="besoin" class="form-label">Type Besoin</label>
                        <select name="besoin" class="form-select">
                            <?php foreach ($besoins as $besoin): ?>
                                <option value="<?php echo $besoin->idCharge; ?>">
                                    <?php echo $besoin->nomcharge; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="centre" class="form-label">Centre</label>
                        <select id="centre" name="centre" class="form-select">
                            <?php foreach ($centres as $centre): ?>
                                <option value="<?php echo $centre->idCentre; ?>">
                                    <?php echo $centre->nomCentre; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                                    
                    <div class="mb-3" id="ouvrierdiv"></div>       

                    <div class="mb-3">
                        <label for="quantite" class="form-label">Quantité</label>
                        <input required type="number" class="form-control" name="quantite" min="1">
                    </div>

                    <div class="mb-3">
                        <label for="jour" class="form-label">Délai de livraison (en jours)</label>
                        <input required type="number" class="form-control" name="jour" min="1">
                    </div>

                    <div class="mb-3">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg" name="charge_type" value="supp" id="confirm">
                                Confirmer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <img src="<?php echo base_url('assets/img/YaourtBon.jpg'); ?>" class="img-fluid rounded shadow" alt="Image yaourt">
            </div>
        </div>
    </div>
</main>

<footer class="bg-primary text-white text-center py-3 mt-5">
    © 2024 M'Yaourt
</footer>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#centre').on('change', function () {
        let centreId = $(this).val();

        $.ajax({
            url: '<?php echo base_url("OuvrierController/getOuvrier/"); ?>' +'/' + centreId,
            type: 'GET',
            success: function (response) {
                try {
                    let ouvriers = JSON.parse(response); 
                    let select = '<select name="ouvrier" class="form-select"><option value="">Sélectionnez un ouvrier</option>';
                
                    ouvriers.ouvriers.forEach(ouvrier => {
                        select += '<option value="' + ouvrier.idOeuvre + '">' + ouvrier.nomOeuvre + '</option>';
                    });
                    select += '</select>';

                    $('#ouvrierdiv').html(select);
                } catch (e) {
                    alert('Erreur lors de la récupération des ouvriers : ' + e);
                }
            },
            error: function () {
                alert('Erreur lors de la récupération des ouvriers.');
            }
        });
    });
});


</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
