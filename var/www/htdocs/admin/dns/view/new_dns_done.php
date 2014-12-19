<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 29/08/2014
 * Time: 14:23
 */ ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Vos DNS - Administration - dev.fairsys.fr</title>
    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8" />
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Tous vos entrée DNS <small><i>Construisez vos bonnes adresses !</i></small></h1>
    </div>

    <!-- Contents -->
    <p class="lead">Gérer vos entrée DNS.</p>
    <p>Vous venez d'ajouter l'entrée DNS suivante. Il faudra un certain temps ou un temps certain afin que la propagation aux autres serveurs DNS se fasse.</p>

    <dl class="dl-horizontal">
        <dt>Nouvel entrée DNS</dt>
        <dd><?php echo $subdomain; ?></dd>
        <dt>Type</dt>
        <dd><?php echo $type; ?></dd>
        <dt>Cible</dt>
        <dd><?php echo $target; ?></dd>
    </dl>

    <a href="/../index.php?app=dns"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>


</div>