<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Vos Réseaux Privés Virtuels (VPN) - Administration</title>
    <!-- Bootstrap core CSS -->
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Vos Réseaux Privés Virtuels (VPN) <small><i>Ou comment être à deux endroits à la fois !</i></small></h1>
    </div>

    <!-- Navigation bar -->
    <?php
    $class_vpn = "active";
    include __DIR__."/../../global/view/nav_bar.php"
    ?>

    <!-- Contents -->
    <p class="lead">Vos Réseaux Privés Virtuels (VPN)</p>
    <p>Vous voulez ajouter des clients ou des serveurs VPN à votre infrastructure locale, les supprimer ou bien modifier ? C'est par là ! </p>

    <p><div class="alert alert-success" role="alert"><b>OK !</b> Votre demande a bien été effectuée : <?php $action; ?></div></p>

    <a href="./../index.php?app=vpn"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>


</div>