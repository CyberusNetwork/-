<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 29/08/2014
 * Time: 00:45
 */ ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>�dition de votre compte utilisateur - Administration</title>
    <!-- Bootstrap core CSS -->
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>�dition de votre compte utilisateur <small><i>On confirme et on ferme !</i></small></h1>
    </div>

    <!-- Contents -->
    <p class="lead">Confirmation de la modification votre compte utilisateur.</p>
    <p>Les modification de votre compte utilisateur est bien enregistr�. C'est presque dans le marbre.</p>

    <!-- USER info -->
    <dl class="dl-horizontal">
        <dt>Pseudonyme</dt>
        <dd><?php echo $username; ?></dd>
        <dt>Nom</dt>
        <dd><?php echo $lastname; ?></dd>
        <dt>Pr�non</dt>
        <dd><?php echo $firstname ?></dd>
        <dt>Adresse mail</dt>
        <dd><?php echo $email ?></dd>
    </dl>
    <!-- Change info button -->
    <a href="/../index.php?app=account"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>

</div>
</body>
</html>


