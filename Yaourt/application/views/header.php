<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M'Yaourt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="titre">

            <p><strong>M'</strong>Yaourt</p>
        </div>
        <pr>
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Insertion de charge</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('FichierController') ?>">table general</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('FileController/convert_txt_to_xlsx') ?>">version excel</a>
                </li>
            </ul>
        </div>
    </header>
    <style>
        .titre{
            /* border: solid; */
            float: right;
            padding-left: 200px;
            padding-right: 100px;
        }
        .titre p {
            font-size: 60px;
            color: white;
        }
        .titre strong{
            color: #FFD700;
        }

    </style>