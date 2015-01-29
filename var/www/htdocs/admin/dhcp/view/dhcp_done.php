<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Vos entrées DHCP - Administration</title>
    <!-- Bootstrap core CSS -->
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Tous vos entrées DHCP <small><i>Distribuer vos bonnes adresses !</i></small></h1>
    </div>

    <!-- Contents -->
    <p class="lead">Gérer vos entrée DHCP.</p>
    <p>Vous voulez ajouter des adresses IP à vos machines, les supprimer ou bien modifier ? C'est juste en dessous :-)</p>

    <p><div class="alert alert-success" role="alert"><b>OK !</b> Votre demande a bien été effectuée : <?php echo $action; ?></div></p>

    <a href="./../index.php?app=dhcp"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>


</div>