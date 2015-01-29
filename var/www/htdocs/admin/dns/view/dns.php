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
        <h1>Tous vos entrées DNS <small><i>Construisez vos bonnes adresses !</i></small></h1>
    </div>

    <!-- Navigation bar -->
    <?php
    $class_dns = "active";
    include __DIR__."/../../global/view/nav_bar.php"
    ?>

    <!-- Contents -->
    <p class="lead">Gérer vos entrée DNS.</p>
    <p>Vous voulez ajouter des adresses locales, les supprimer ou bien modifier ? C'est juste en dessous :-)</p>

    <!-- DNS Table -->
    <div class="panel panel-default">
        <div class="panel-heading">Liste de vos entrées DNS dans le DNS cache</div>
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
            foreach($dns->getDatas() as $line){ ?>
                <tr>
                    <td>
                        <a href="./dns/index.php?page=delete_dns&deldns=<?php echo $line["domain"]; ?>" title="Supprimer votre champs DNS"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
                    </td>
                    <td><?php echo $line["domain"]; ?></td>
                    <td><?php echo $line["type"]; ?></td>
                    <td><?php echo $line["target"]; ?></td>
                    <td><?php echo $line["created"]; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Add DNS bar -->
    <form class="form-horizontal" role="form" action="./dns/index.php?page=new_dns" method="post">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="NewDns">Nouvelle entrée DNS</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="NewDns" placeholder="example1.cbnet.itinet.fr" required pattern="^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"for="Type">Type</label>
            <div class="col-sm-10">
                <SELECT class ="form-control" name="Type">
                    <OPTION>A
                    <OPTION>CNAME
                    <OPTION>MX
                    <OPTION>NS
                </SELECT>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="Target">Cible</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Target" placeholder="'www' pour CNAME ou IPv4 pour A/MX/NS" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="button"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success" id="new_dns"><i class="glyphicon glyphicon-plus"></i> Nouveau</button>
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