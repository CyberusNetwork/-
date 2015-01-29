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

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <b>PSK</b>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">

                    <p>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#ServerPSK" aria-expanded="true" aria-controls="ServerPSK">
                        Server VPN PSK
                    </button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#ClientPSK" aria-expanded="false" aria-controls="ClientPSK">
                        Client VPN PSK
                    </button>
                    </p>

                    <div class="collapse" id="ServerPSK">
                        <div class="well">
                            <!-- ServerPSK content-->
                            <!-- ServerPSK Table -->
                            <div class="panel panel-default">
                                <div class="panel-heading"><i>Liste de vos serveurs VPN-PSK</i></div>
                                <table id="ServerPSKTable" class="table">
                                    <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Nom</th>
                                        <th>IP Serveur</th>
                                        <th>TUN Serveur</th>
                                        <th>TUN Client</th>
                                        <th>Port</th>
                                        <th>Interface</th>
                                        <th>Actif</th>
                                        <th>Crée le</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  // Parcours du tableau de données retourné par la classe VPN - PSK
                                     foreach($vpnServerPSK->getDatasServerPSK() as $line){ ?>
                                        <tr>
                                            <td>
                                                <a href="./vpn/index.php?page=enable_vpn_server_psk&ServerID=<?php echo $line["id"]; ?>&ServerIP=<?php echo $line["ipserver"]; ?>" title="Active votre serveur VPN"><button type="button" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-cloud"></i></button></a>
                                                <a href="./vpn/index.php?page=disable_vpn_server_psk&ServerID=<?php echo $line["id"]; ?>&ServerIP=<?php echo $line["ipserver"]; ?>" title="Desactiver votre serveur VPN"><button type="button" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-cloud"></i></i></button></a>
                                                <a href="./vpn/index.php?page=delete_vpn_server_psk&ServerID=<?php echo $line["id"]; ?>&ServerIP=<?php echo $line["ipserver"]; ?>" title="Supprimer votre serveur VPN"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button></a>
                                            </td>
                                            <td><?php echo $line["servername"]; ?></td>
                                            <td><?php echo $line["ipserver"]; ?></td>
                                            <td><?php echo $line["tunserver"]; ?></td>
                                            <td><?php echo $line["tunclient"]; ?></td>
                                            <td><?php echo $line["port"]; ?></td>
                                            <td><?php echo $line["interface"]; ?></td>
                                            <td><?php echo $line["active"]; ?></td>
                                            <td><?php echo $line["created"]; ?></td>
                                        </tr>
                                    <?php  } ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- ServerPSK form -->
                            <p>
                            <form class="form-horizontal" id='ServerPSKForm' role="form" action="./vpn/index.php?page=new_vpn_server_psk" method="post">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="NewVPNServerPSK">Nom du server</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="NewVPNserverPSK" placeholder="Nom (max : 20 caractères)" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="IPServer">IP Server</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="IPServerPSK" placeholder="192.168.0.1" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="IPTunServer">IP Tunnel Server</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="IPTunServer" placeholder="192.168.0.2" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="IPTunClient">IP Tunnel Client</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="IPTunClient" placeholder="192.168.0.3" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Target">Port</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Port" placeholder="0-65535" required pattern="(\d{1,5})">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Interface">Interface</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Interface" placeholder="tun[Number]" required pattern="tun(\d{1,5})">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="button"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success" id="new_vpn_server_psk"><i class="glyphicon glyphicon-plus"></i> Nouveau Serveur VPN-PSK</button>
                                    </div>
                                </div>
                            </form>
                            </p>
                        </div>
                    </div>
                    <div class="collapse" id="ClientPSK">
                        <div class="well">
                            <!-- ClientPSK content-->
                            <!-- ClientPSK Table -->
                            <div class="panel panel-default">
                                <div class="panel-heading"><i>Liste de vos clients VPN-PSK</i></div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Nom du client</th>
                                        <th>Nom du server</th>
                                        <th>IP Tunnel client</th>
                                        <th>Port</th>
                                        <th>Interface</th>
                                        <th>Crée le</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php // Parcours du tableau de données retourné par la classe VPN - PSK
                                    foreach($vpnClientPSK->getDatasClientPSK() as $line2){ ?>
                                    <tr>
                                        <td>
                                            <a href="./vpn/index.php?page=delete_vpn_client_psk&ClientID=<?php echo $line2["id"]; ?>&IPServer=<?php echo $line2["ipserver"]; ?>&ClientName=<?php echo $line2["clientname"]; ?>" title="Supprimer votre client VPN"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
                                        </td>
                                        <td><?php echo $line2["clientname"]; ?></td>
                                        <td><?php echo $line2["servername"]; ?></td>
                                        <td><?php echo $line2["tunclient"]; ?></td>
                                        <td><?php echo $line2["port"]; ?></td>
                                        <td><?php echo $line2["interface"]; ?></td>
                                        <td><?php echo $line2["created"]; ?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- ClientPSK form -->
                            <p>
                            <form class="form-horizontal" role="form" action="./vpn/index.php?page=new_vpn_client_psk" method="post">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="IPServerPSK">Nom du server</label>
                                    <div class="col-sm-10">
                                        <select class ="form-control" name="IPServerPSK">
                                            <?php // Parcours du tableau de données retourné par la classe VPN - PSK
                                            foreach($vpnServerPSK->getDatasServerPSK() as $line3){ ?>
                                                <option value="<?php echo $line3["ipserver"]; ?>"><?php echo $line3["servername"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="NewClientPSK">Nom du client</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="NewClientPSK" placeholder="Nom (max : 20 caractères)" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="IPClientPSK">IP Tunnel Client</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="IPClientPSK" placeholder="192.168.0.2" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="ClientEmail">Adresse mail</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="ClientEmail" placeholder="prenom.nom@localhost.org" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="button"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success" id="new_vpn_client_psk"><i class="glyphicon glyphicon-plus"></i> Nouveau Client VPN-PSK</button>
                                    </div>
                                </div>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <b>X509</b>
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">

                   <p>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#ServerX509" aria-expanded="false" aria-controls="ServerX509">
                            Server VPN x509
                        </button>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#ClientX509" aria-expanded="false" aria-controls="ClientX509">
                            Client VPN x509
                        </button>
                    </p>

                    <div class="collapse" id="ServerX509">
                        <div class="well">
                            <!-- ServerX509 content-->
                            <!-- ServerX509 Table -->
                            <div class="panel panel-default">
                                <div class="panel-heading"><i>Liste de vos serveurs VPN-X509</i></div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Nom</th>
                                        <th>IP Serveur</th>
                                        <th>Masque</th>
                                        <th>Port</th>
                                        <th>Interface</th>
                                        <th>Actif</th>
                                        <th>Voisinage</th>
                                        <th>Crée le</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php // Parcours du tableau de données retourné par la classe VPN - PSK
                                    foreach($vpnServerX509->getDatasServerX509() as $line4){ ?>
                                    <tr>
                                        <td>
                                            <a href="./vpn/index.php?page=enable_vpn_server_X509&ServerID=<?php echo $line4["id"]; ?>&ServerIP=<?php echo $line4["ipserver"]; ?>" title="Active votre serveur VPN"><button type="button" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-cloud"></i></button></a>
                                            <a href="./vpn/index.php?page=disable_vpn_server_X509&ServerID=<?php echo $line4["id"]; ?>&ServerIP=<?php echo $line4["ipserver"]; ?>" title="Desactiver votre serveur VPN"><button type="button" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-cloud"></i></i></button></a>
                                            <a href="./vpn/index.php?page=enable_nwn_vpn_server_X509&ServerID=<?php echo $line4["id"]; ?>&ServerIP=<?php echo $line4["ipserver"]; ?>" title="Activer votre voisinage réseau"><button type="button" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-transfer"></i></i></button></a>
                                            <a href="./vpn/index.php?page=disable_nwn_vpn_server_X509&ServerID=<?php echo $line4["id"]; ?>&ServerIP=<?php echo $line4["ipserver"]; ?>" title="Desactiver votre voisinage réseau"><button type="button" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-transfer"></i></i></button></a>
                                            <a href="./vpn/index.php?page=delete_vpn_server_X509&ServerID=<?php echo $line4["id"]; ?>&ServerIP=<?php echo $line4["ipserver"]; ?>" title="Supprimer votre serveur VPN"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button></a>
                                        </td>
                                        <td><?php echo $line4["servername"]; ?></td>
                                        <td><?php echo $line4["ipserver"]; ?></td>
                                        <td><?php echo $line4["mask"]; ?></td>
                                        <td><?php echo $line4["port"]; ?></td>
                                        <td><?php echo $line4["interface"]; ?></td>
                                        <td><?php echo $line4["active"]; ?></td>
                                        <td><?php echo $line4["nwn_active"]; ?></td>
                                        <td><?php echo $line4["created"]; ?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- ServerX509 form -->
                            <p>
                            <form class="form-horizontal" role="form" action="./vpn/index.php?page=new_vpn_server_X509" method="post">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="NewDns">Nom du server</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="NewVPNServerX509" placeholder="Nom (max : 20 caractères)" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="IPServer">IP Server</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="IPServerX509" placeholder="192.168.0.1" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="mask">Masque</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="MaskX509" placeholder="255.255.255.0" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Port">Port</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Port" placeholder="56980" required pattern="(\d{1,5})">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Interface">Interface</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Interface" placeholder="tun[Number]" required pattern="tun(\d{1,5})">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="button"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success" id="new_vpn_server_psk"><i class="glyphicon glyphicon-plus"></i> Nouveau Serveur VPN-X509</button>
                                    </div>
                                </div>
                            </form>
                            </p>

                        </div>
                    </div>
                    <div class="collapse" id="ClientX509">
                        <div class="well">
                            <!-- ClientX509 content-->
                            <!-- ClientX509 Table -->
                            <div class="panel panel-default">
                                <div class="panel-heading"><i>Liste de vos Client VPN-X509</i></div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Nom du client</th>
                                        <th>Nom du server</th>
                                        <th>Port</th>
                                        <th>Interface</th>
                                        <th>Crée le</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php // Parcours du tableau de données retourné par la classe VPN - X509
                                    foreach($vpnClientX509->getDatasClientX509() as $line5){ ?>
                                    <tr>
                                        <td>
                                            <a href="./dns/index.php?page=delete_vpn_client_X509&clientID=<?php echo $line5["id"]; ?>&IPServer=<?php echo $line5["ipserver"]; ?>&ClientName=<?php echo $line5["clientname"]; ?>" title="Supprimer votre client VPN"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
                                        </td>
                                        <td><?php echo $line5["clientname"]; ?></td>
                                        <td><?php echo $line5["servername"]; ?></td>
                                        <td><?php echo $line5["port"]; ?></td>
                                        <td><?php echo $line5["interface"]; ?></td>
                                        <td><?php echo $line5["created"]; ?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Clientx509 form -->
                            <p>
                            <form class="form-horizontal" role="form" action="./vpn/index.php?page=new_vpn_client_X509" method="post">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="IPServerX509">Nom du server</label>
                                    <div class="col-sm-10">
                                        <select class ="form-control" name="IPServerX509">
                                            <?php // Parcours du tableau de données retourné par la classe VPN - PSK
                                            foreach($vpnServerX509->getDatasServerX509() as $line6){ ?>
                                                <option value="<?php echo $line6["ipserver"]; ?>"><?php echo $line6["servername"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="ClientNameX509">Nom du client</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="ClientNameX509" placeholder="Nom (max : 20 caractères)" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="ClientEmail">Adresse mail</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="ClientEmail" placeholder="prenom.nom@localhost.org" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="button"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success" id="new_vpn_client_X509"><i class="glyphicon glyphicon-plus"></i> Nouveau Client VPN-X509</button>
                                    </div>
                                </div>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php
    include __DIR__."/../../global/view/footer.php"
    ?>
</div>
</body>
</html>