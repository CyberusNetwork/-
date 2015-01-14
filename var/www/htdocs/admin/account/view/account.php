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
    <title>Votre compte utilisateur - Administration - Cyberus Network</title>
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Toutes les informations de vos comptes <small><i>C'est mieux que les RG !</i></small></h1>
    </div>

    <!-- Navigation bar -->
    <?php
        $class_account = "active";
        include __DIR__."/../../global/view/nav_bar.php"
    ?>

    <!-- Contents -->
    <p class="lead">Gérer vos comptes utilisateurs.</p>
    <p>Voici les details de votre compte. C'est presque aussi bien que Facebook, mais en un peu plus personnel :-)</p>

    <!-- USER Account Table -->
    <div class="panel panel-default">
        <div class="panel-heading">Liste de vos comptes</div>
        <table class="table">
            <thead>
            <tr>
                <th>Actions</th>
                <th>Pseudonyme</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Dernière modification</th>
            </tr>
            </thead>
            <tbody>
            <?php // Parcours du tableau de données retourné par la classe Account
            foreach($account->getDatas() as $line){
                ?>
                <tr>
                    <td>
                        <?php // todo modifier function ?>
                        <a href="./account/index.php?page=edit_account&userid=<?php echo $line["id"]; ?>" title="Modifier ce compte"><button type="button" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Modifier</button></a>
                        <a href="./account/index.php?page=delete_account&userid=<?php echo $line["id"]; ?>" title="Supprimer ce compte"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
                    </td>
                    <td><?php echo $line["username"]; ?></td>
                    <td><?php echo $line["lastname"]; ?></td>
                    <td><?php echo $line["firstname"]; ?></td>
                    <td><?php echo $line["mail"]; ?></td>
                    <td><?php echo $line["edited"]; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Change info button -->
    <a href="./account/index.php?page=new_account"><button type="button" class="btn btn-success" id="change_account"><i class="glyphicon glyphicon-plus"></i> Nouveau compte</button></a>
    <!-- footer -->
    <?php
    include __DIR__."/../../global/view/footer.php"
    ?>
</div>
</body>
</html>

