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

    <!-- Navigation bar -->
    <?php
    $class_dhcp = "active";
    include __DIR__."/../../global/view/nav_bar.php"
    ?>

    <!-- Contents -->
    <p class="lead">Gérer vos entrée DHCP.</p>
    <p>Vous voulez ajouter des adresses IP à vos machines, les supprimer ou bien modifier ? C'est juste en dessous :-)</p>
    <h4>Range IP</h4>
    <!-- Range Table -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h5>Sis0 - LAN </h5>
                <dl class="dl-horizontal">
                    <?php // Parcours du tableau de données retourné par la classe DNS
                    foreach($datasRangeSis0 as $line){ ?>
                    <dt>Première IP</dt>
                    <dd><?php echo $line["ipstart"]; ?></dd>
                    <dt>Dernière IP</dt>
                    <dd><?php echo $line["ipend"]; ?></dd>
                    <?php } ?>
                </dl>
            </div>
            <div class="col-md-6">
                <h5>Sis1 - Management </h5>
                <dl class="dl-horizontal">
                    <?php // Parcours du tableau de données retourné par la classe DNS
                    foreach($datasRangeSis1 as $line){ ?>
                        <dt>Première IP</dt>
                        <dd><?php echo $line["ipstart"]; ?></dd>
                        <dt>Dernière IP</dt>
                        <dd><?php echo $line["ipend"]; ?></dd>
                    <?php } ?>
                </dl>
            </div>
        </div>
        <!-- Add DHCP Range bar -->
        <form class="form-horizontal" role="form" action="./dhcp/index.php?page=edit_dhcp_range" method="post">

            <div class="form-group">
                <label class="col-sm-2 control-label" for="IPStart">Première IP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="IPStart" placeholder="192.168.0.1" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"for="IPEnd">Dernière IP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="IPEnd" placeholder="192.168.15.1" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="Interface">Interface</label>
                <div class="col-sm-10">
                    <select class ="form-control" name="Interface">
                        <option value="sis0">sis0 - LAN</option>
                        <option value="sis1">sis1 - MANAGEMENT</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="button"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success" id="new_static_IP"><i class="glyphicon glyphicon-plus"></i> Nouveau</button>
                </div>
            </div>
        </form>
    </div>

    <h4>Adressage DHCP : MAC / IP</h4>
    <!-- DHCP Table -->
    <div class="panel panel-default">
        <div class="panel-heading">Liste de vos entrées DHCP</div>
        <table class="table">
            <thead>
            <tr>
                <th>Actions</th>
                <th>Nom de la machine</th>
                <th>Adresse MAC</th>
                <th>IP attribué</th>
                <th>Crée le</th>
            </tr>
            </thead>
            <tbody>
            <?php // Parcours du tableau de données retourné par la classe DHCP
            foreach($dhcp->getDatasStaticIP() as $line){ ?>
                <tr>
                    <td>
                        <a href="./dhcp/index.php?page=delete_dhcp_static&StaticID=<?php echo $line["id"]; ?>&StaticName=<?php echo $line["hostname"]; ?>" title="Supprimer votre attibution d'IP"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
                    </td>
                    <td><?php echo $line["hostname"]; ?></td>
                    <td><?php echo $line["mac"]; ?></td>
                    <td><?php echo $line["ip"]; ?></td>
                    <td><?php echo $line["created"]; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Add DHCP static bar -->
    <form class="form-horizontal" role="form" action="./dhcp/index.php?page=new_dhcp_static" method="post">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="NewHostname">Nom de domaine</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="NewHostname" placeholder="example1.cbnet.itinet.fr" required pattern="^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"for="AddressMAC">Adresse MAC</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="AddressMAC" placeholder="5E:FF:56:A2:AF:15" required pattern="^([0-9a-fA-F][0-9a-fA-F]:){5}([0-9a-fA-F][0-9a-fA-F])$">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="AddressIP">Adresse IP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="AddressIP" placeholder="192.168.0.1" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="button"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success" id="new_static_IP"><i class="glyphicon glyphicon-plus"></i> Nouveau</button>
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