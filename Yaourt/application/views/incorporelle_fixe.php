<p>Charge de nature fixe :</p>
<div id="centresContainer">
    <?php if (!empty($centre)): ?>
        <?php foreach ($centre as $c): ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="chargeFixe" id="option_<?php echo $c->idCentre; ?>" value="<?php echo $c->idCentre; ?>">
                <label class="form-check-label" for="option_<?php echo $c->idCentre; ?>">
                    <?php echo $c->nomCentre; ?>
                </label>
                <!-- Pourcentage fixe à 100% -->
                <input type="hidden" name="pourcentage[<?php echo $c->idCentre; ?>]" value="100">
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun centre disponible.</p>
    <?php endif; ?>
</div>
