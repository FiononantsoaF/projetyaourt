<p>Charge de nature variable :</p>
<div id="centresContainer">
    <?php if (!empty($centre)): ?>
        <?php foreach ($centre as $c): ?>
            <div class="form-check" style="display: flex; align-items: center; margin-bottom: 10px;">
                <input class="form-check-input" type="checkbox" name="chargeVariable[<?php echo $c->idCentre; ?>]" id="centre_<?php echo $c->idCentre; ?>" value="<?php echo $c->idCentre; ?>">
                <label class="form-check-label" for="centre_<?php echo $c->idCentre; ?>" style="margin-right: 10px;">
                    <?php echo $c->nomCentre; ?>
                </label>
                <div class="wave-group" style="flex: 1;">
                    <input required type="number" class="input" style="width: 100px;" placeholder="%" name="pourcentage[<?php echo $c->idCentre; ?>]">
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun centre disponible</p>
    <?php endif; ?>
</div>
