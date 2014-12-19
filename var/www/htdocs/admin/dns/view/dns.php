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

    <!-- Navigation bar -->
    <?php
    $class_dns = "active";
    include __DIR__."/../../global/view/nav_bar.php"
    ?>

    <!-- Contents -->
    <p class="lead">Gérer vos entrée DNS.</p>
    <p>Vous voulez ajouter des adresses, sous la forme de "champs.pseudo.dev.fairsys.fr", les supprimer ou bien modifier ? C'est juste en dessous :-)</p>

    <!-- DNS Table -->
    <div class="panel panel-default">
        <div class="panel-heading">Liste de vos entrées DNS</div>
        <table class="table">
            <thead>
            <tr>
                <th>Actions</th>
                <th>Champs</th>
                <th>Type</th>
                <th>Cible</th>
                <th>Crée le</th>
            </tr>
            </thead>
            <tbody>
            <?php // Parcours du tableau de données retourné par la classe DNS
            foreach($dns->getDatas() as $line){
                ?>
                <tr>
                    <td>
                        <a href="/dns/index.php?page=delete_dns&deldns=<?php echo $line["sub_dom"]; ?>&type=<?php echo $line["type"]; ?>&target=<?php echo $line["target"]; ?>" title="Supprimer votre champs DNS"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
                    </td>
                    <td><?php echo $line["sub_dom"]; ?></td>
                    <td><?php echo $line["type"]; ?></td>
                    <td><?php echo $line["target"]; ?></td>
                    <td><?php echo $line["created"]; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Add DNS bar -->
    <form class="form-horizontal" role="form" action="/dns/index.php?page=new_dns" method="post">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="NewDns">Nouvelle entrée DNS</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="NewDns" placeholder="ex. mail, blog, forum">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="UserDomain">Domaine de l'utilisateur</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="UserDomain" value="<?php echo $user_domain; ?>" readonly>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"for="Type">Type</label>
            <div class="col-sm-10">
                <SELECT class ="form-control" name="Type">
                    <OPTION>CNAME
                    <OPTION>A
                    <OPTION>AAAA
                </SELECT>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="Target">Cible</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Target" placeholder="'www' pour CNAME (cible le server), IPv4 pour A ou IPv6 pour le AAAA">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="button"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success" id="new_mail"><i class="glyphicon glyphicon-plus"></i> Nouveau</button>
            </div>
        </div>

    </form>

    <!-- footer -->
    <?php
    include __DIR__."/../../global/view/footer.php"
    ?>
</div>
</body>
</html>