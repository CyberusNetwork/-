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
    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8" />
    <title>Votre compte utilisateur - Administration - dev.fairsys.fr</title>
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
        <dd><?php echo $account->getDatas()["username"]; ?></dd>
        <dt>Nom</dt>
        <dd><?php echo $account->getDatas()["lastname"]; ?></dd>
        <dt>Prénon</dt>
        <dd><?php echo $account->getDatas()["firstname"]; ?></dd>
        <dt>Adresse mail</dt>
        <dd><?php echo $account->getDatas()["mail"]; ?></dd>
        <dt>Dernière modification</dt>
        <dd><?php echo $account->getDatas()["edited"]; ?></dd>

    </dl>

        <a href="index.php?page=delete_account_confirmed"><button type="button" class="btn btn-warning" id="delete_ok"><i class="glyphicon glyphicon-ok"></i> Valider</button></a>
        <a href="/../index.php?app=account"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>
</div>
</body>
</html>

