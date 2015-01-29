<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Vos entr�es DHCP - Administration</title>
    <!-- Bootstrap core CSS -->
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Tous vos entr�es DHCP <small><i>Distribuer vos bonnes adresses !</i></small></h1>
    </div>

    <!-- Contents -->
    <p class="lead">G�rer vos entr�e DHCP.</p>
    <p>Vous voulez ajouter des adresses IP � vos machines, les supprimer ou bien modifier ? C'est juste en dessous :-)</p>

    <p><div class="alert alert-success" role="alert"><b>OK !</b> Votre demande a bien �t� effectu�e : <?php echo $action; ?></div></p>

    <a href="./../index.php?app=dhcp"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>


</div>