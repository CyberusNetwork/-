<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 29/08/2014
 * Time: 14:27
 */ ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Vos DNS - Administration</title>
    <!-- Bootstrap core CSS -->
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Tous vos entr�e DNS <small><i>Construisez vos bonnes adresses !</i></small></h1>
    </div>

    <!-- Contents -->
    <p class="lead">G�rer vos entr�e DNS.</p>
    <p>Vous venez de supprimer l'entr�e DNS suivante. Il faudra un certain temps ou un temps certain afin que la propagation aux autres serveurs DNS se fasse.</p>

    <dl class="dl-horizontal">
        <dt>Entr�e DNS supprim�e</dt>
        <dd><?php echo $domain; ?></dd>
    </dl>

    <a href="./../index.php?app=dns"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>

</div>