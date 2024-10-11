<main class="container mt-5">
    <h2>Page d'Insertion de charge :</h2>
    <div class="conteneur">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <form method="post" action="<?php echo base_url('AdminController/handle_charge'); ?>">
                    <div class="mb-3">
                        <label for="valeurCharge" class="form-label">Valeur de la charge</label>
                        <div class="wave-group">
                            <input required type="text" class="input" name="charge">
                            <span class="bar"></span>
                            <label class="label">
                                <span class="label-char" style="--index: 0">E</span>
                                <span class="label-char" style="--index: 1">n</span>
                                <span class="label-char" style="--index: 2">t</span>
                                <span class="label-char" style="--index: 3">r</span>
                                <span class="label-char" style="--index: 4">e</span>
                                <span class="label-char" style="--index: 5">r</span>
                                <span class="label-char" style="--index: 6">.</span>
                                <span class="label-char" style="--index: 7">l</span>
                                <span class="label-char" style="--index: 8">a</span>
                                <span class="label-char" style="--index: 9">.</span>
                                <span class="label-char" style="--index: 10">v</span>
                                <span class="label-char" style="--index: 11">a</span>
                                <span class="label-char" style="--index: 12">l</span>
                                <span class="label-char" style="--index: 13">e</span>
                                <span class="label-char" style="--index: 14">u</span>
                                <span class="label-char" style="--index: 15">r</span>
                            </label>
                        </div>
                    </div>
                    <div> 
                    <input required type="number" class="input" name="montant">
                            <span class="bar"></span>
                            <label class="label">Montant :
                            </label>
                    </di>
                </form>
            </div>
            
            <div class="col-md-6">
                <img src="<?php echo base_url('assets/img/YaourtBon.jpg'); ?>" class="img-fluid rounded" alt="Image yaourt">
            </div>
        </div>
    </div>
</main>

<footer class="bg-primary text-white text-center py-3 mt-5" style="background-color: aquamarine;">
    © 2024 M'Yaourt
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
