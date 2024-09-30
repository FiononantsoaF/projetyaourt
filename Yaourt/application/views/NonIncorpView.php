<main class="container mt-5">
    <h2>Charge non incorporelle :</h2>
    <div class="conteneur">

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <form method="post" action="<?php echo base_url('NonInCorpController/insertion_nonincorp'); ?>">
                    <div class="mb-3">
                        <label for="valeurCharge" class="form-label">Insertion de charge non incorporelle</label>
                        <div class="wave-group">
                            <input required="" type="number" class="input" name="montant">
                            <span class="bar"></span>
                            <label class="label">
                                <span class="label-char" style="--index: 0">M</span>
                                <span class="label-char" style="--index: 1">o</span>
                                <span class="label-char" style="--index: 2">n</span>
                                <span class="label-char" style="--index: 3">t</span>
                                <span class="label-char" style="--index: 4">a</span>
                                <span class="label-char" style="--index: 5">n</span>
                                <span class="label-char" style="--index: 6">t</span>
                            </label>
                        </div>
                        <p>Motif :</p>
                        <div class="wave-group">
                        <select name="motif" class="input">
                            <option value="">Sélectionnez un motif</option>
                            <?php if (!empty($allnonincorp)) : ?>
                                <?php foreach ($allnonincorp as $motif) : ?>
                                    <option value="<?php echo $motif->idMotif; ?>">
                                        <?php echo $motif->nomMotif; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Aucun motif disponible</option>
                            <?php endif; ?>
                        </select>
                            <span class="bar"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <img src="<?php echo base_url('assets/img/YaourtBon.jpg'); ?>" class="img-fluid rounded" alt="Image yaourt">
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>