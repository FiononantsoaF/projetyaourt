<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="<?php echo base_url('AdminController/login'); ?>">
    <label for="nomAdmin">Nom d'utilisateur :</label>
    <input type="text" name="nomAdmin" required><br>

    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" required><br>

    <input type="submit" value="Se connecter">
</form>

<!-- Affichage des erreurs s'il y en a -->
<?php if ($this->session->flashdata('error')): ?>
    <p style="color:red;"><?php echo $this->session->flashdata('error'); ?></p>
<?php endif; ?>

</body>
</html>