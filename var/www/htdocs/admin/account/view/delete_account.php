<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 29/08/2014
 * Time: 12:28
 */?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
    <title>Votre compte utilisateur - Administration</title>
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Suppression de votre compte utilisateur <small><i>Vous en êtes sûr ?</i></small></h1>
    </div>
    <p class="lead">Gérer votre compte utilisateur.</p>
    <p>Merci de bien vouloir confirmer la suppression de votre compte ci-dessous :</p>
    <p class="text-danger"><b>ATTENTION : Cette action est irréversible. Vous êtes prévenus !</b></p>

    <!-- USER info -->
    <dl class="dl-horizontal">
        <dt>Pseudonyme</dt>
        <dd><?php echo $line["username"]; ?></dd>
        <dt>Nom</dt>
        <dd><?php echo $line["lastname"]; ?></dd>
        <dt>Prénom</dt>
        <dd><?php echo $line["firstname"]; ?></dd>
        <dt>Adresse mail</dt>
        <dd><?php echo $line["mail"]; ?></dd>
        <dt>Dernière modification</dt>
        <dd><?php echo $line["edited"]; ?></dd>

    </dl>

        <a href="index.php?page=delete_account_confirmed&UserID=<?php echo $line["id"]; ?>"><button type="button" class="btn btn-warning" id="delete_ok"><i class="glyphicon glyphicon-ok"></i> Valider</button></a>
        <a href="./../index.php?app=account"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>
</div>
</body>
</html>

