<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 28/08/2014
 * Time: 17:10
 */ ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Création de votre compte utilisateur - Administration</title>
    <!-- Bootstrap core CSS -->
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Création de votre compte utilisateur <small><i>Désolé, mais il nous manque une case !</i></small></h1>
    </div>

    <!-- Contents -->
    <p class="lead">Confirmation de la création votre compte utilisateur.</p>
    <p>Votre compte utilisateur est bien enregistré. Amusez-vous bien !</p>

    <!-- USER info -->
    <dl class="dl-horizontal">
        <dt>Pseudonyme</dt>
        <dd><?php echo $username; ?></dd>
        <dt>Nom</dt>
        <dd><?php echo $lastname; ?></dd>
        <dt>Prénom</dt>
        <dd><?php echo $firstname ?></dd>
        <dt>Adresse mail</dt>
        <dd><?php echo $email ?></dd>
    </dl>
    <!-- Change info button -->
    <a href="login.php"><button type="button" class="btn btn-success" id="login"><i class="glyphicon glyphicon-link"></i> Connection</button></a>
    <a href="../index.php?app=account"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>
</div>
</body>
</html>
