<main class="container mt-5">
    <h2>Charge incorporelle :</h2>
    <div class="conteneur">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <form id="chargeForm" method="post" action="<?php echo site_url('IncorpController/inserer_incorp'); ?>"> <!-- Remplacez par votre contrôleur -->
                    <div class="mb-3">
                        <label for="valeurCharge" class="form-label">Insertion de charge incorporelle</label>
                        <input required type="number" class="input" style="width: 100px;" placeholder="Montant" name="montant">
                        
                        <p>Unité d'œuvre :</p>
                        <div class="wave-group">
                            <select name="unite" class="input" required>
                                <option value="">Sélectionnez une unité</option>
                                <?php if (!empty($allincorp)) : ?>
                                    <?php foreach ($allincorp as $unites) : ?>
                                        <option value="<?php echo $unites->idUnite; ?>"><?php echo $unites->nomUnite; ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option value="">Aucune unité disponible</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        
                        <p>Nature :</p>
                        <div class="wave-group">
                            <select name="nature" class="input" id="natureSelect" required>
                                <option value="">Sélectionnez la nature</option>
                                <option value="1">Fixe</option>
                                <option value="2">Variable</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Section des centres -->
                    <div class="mb-3" id="centresContainer"></div>
                    
                    <div class="mb-3">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg">Valider</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6" id="dynamicView">
                <img src="<?php echo base_url('assets/img/YaourtBon.jpg') ?>" class="img-fluid rounded" alt="Image yaourt">
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#natureSelect').on('change', function () {
        let nature = $(this).val();
        let uniteId = $('select[name="unite"]').val(); // Récupérer l'unité sélectionnée
        
        // Appel Ajax pour récupérer les centres correspondants
        $.ajax({
            url: nature === '1' ? 'incorporelle_fixe' : 'incorporelle_variable', // URL en fonction de la nature sélectionnée
            type: 'GET',
            data: { uniteId: uniteId },
            success: function (response) {
                $('#centresContainer').html(response);
            },
            error: function () {
                alert('Erreur lors du chargement des centres.');
            }
        });
    });
});
</script>
