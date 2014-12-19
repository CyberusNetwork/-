<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 27/08/2014
 * Time: 13:40
 */

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Votre compte utilisateur - Administration - dev.fairsys.fr</title>
    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8" />
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Toutes les informations de votre compte <small><i>C'est mieux que les RG !</i></small></h1>
    </div>

    <!-- Navigation bar -->
    <?php
        $class_account = "active";
        include __DIR__."/../../global/view/nav_bar.php"
    ?>

    <!-- Contents -->
    <p class="lead">Gérer votre compte utilisateur.</p>
    <p>Voici votre "fiche" de renseignement. C'est presque aussi bien que Facebook, mais en un peu plus personnel :-)</p>

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
    <!-- Change info button -->
    <a href="/account/index.php?page=edit_account"><button type="button" class="btn btn-warning" id="change_account"><i class="glyphicon glyphicon-edit"></i> Éditer</button></a>
    <a href="/account/index.php?page=delete_account"><button type="button" class="btn btn-danger" id="delete_account"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
    <!-- footer -->
    <?php
    include __DIR__."/../../global/view/footer.php"
    ?>
</div>
</body>
</html>

