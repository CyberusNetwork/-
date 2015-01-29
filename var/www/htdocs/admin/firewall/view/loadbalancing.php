<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Load Balancing - Administration</title>
    <!-- Bootstrap core CSS -->
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
    <div class="container-fluid" >

        <!-- Header -->
        <div class="page-header">
            <h1>Load Balancing <small><i>Le basculement, c'est ici !</i></small></h1>
        </div>

        <!-- Navigation bar -->
        <?php
        $class_firewall = "active";
        include __DIR__."/../../global/view/nav_bar.php"
        ?>

        <!-- Contents -->
        <p class="lead">Load Balancing</p>
        <p>Ici on fait de la Load Balancing : </p>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            </div>
            <?php
            include_once "macro.php"; 
            ?>
            <!-- Load Balancing -->
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <b>Load Balancing</b>
                        </a>
                    </h4>
                </div>
                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <!-- Load Balancing content-->
                        <!-- Load Balancing Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        <b>Liste de Load Balancing</b>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <table id="Macro_Table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Actions</th>
                                            <th>Macro Interface 1</th>
                                            <th>Macro IP 1</th>
                                            <th>Macro Interface 2</th>
                                            <th>Macro IP 2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- sql -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                <b>Paramètres Load Balancing</b>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <p>
                            <form class="form-horizontal" id='TableForm' role="form" action="./firewall/index.php?page=table" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="name_Table">Exemple : (\$sfr_macro \$sfr_ip_macro), (\$free_macro \$free_ip_macro), (\$lan_macro \$lan_ip_macro) </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nomTable" placeholder="Exemple : (\$sfr_macro \$sfr_ip_macro), (\$free_macro \$free_ip_macro), (\$lan_macro \$lan_ip_macro)">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="button"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success" id="Table"><i class="glyphicon glyphicon-plus"></i> Ajouter </button>
                                    </div>
                                </div>
                            </form>
                        </p>
                    </div>
                </div>

                        <!-- Load Balancing form -->
                        <p>
                            <form class="form-horizontal" id='macroForm' role="form" action="./firewall/index.php?page=Load Balancing" method="post">
                                <!-- Bouton qui supprime la Load Balancing -->
<!--                    <td>
                                                <a href="./firewall/index.php?page=delete_macro=<?php echo $line["id"]; ?>" title="Supprime une Load Balancing"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
                                        </td>
                                    -->
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="Interface">Macro Interface 1</label>
                                        <div class="col-sm-10">
                                            <select class ="form-control" name="nomInterface">
                                                    <?php // Parcours du tableau de données retourné par la classe VPN - PSK
                                                 # foreach($vpnServerPSK->getDatasServerPSK() as $line){ ?>
                                                 <option value="<?php #echo $line["ipserver"]; ?>"><?php #echo $line["servername"]; ?></option>
                                                 <?php #} ?>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-sm-2 control-label" for="Macro_IP">Macro IP 1</label>
                                        <div class="col-sm-10">
                                            <select class ="form-control" name="portExt">
                                                    <?php // Parcours du tableau de données retourné par la classe VPN - PSK
                                                 # foreach($vpnServerPSK->getDatasServerPSK() as $line){ ?>
                                                 <option value="<?php #echo $line["ipserver"]; ?>"><?php #echo $line["servername"]; ?></option>
                                                 <?php #} ?>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-sm-2 control-label" for="Macro_IP">Macro Interface 1</label>
                                        <div class="col-sm-10">
                                            <select class ="form-control" name="portInt">
                                                    <?php // Parcours du tableau de données retourné par la classe VPN - PSK
                                                 # foreach($vpnServerPSK->getDatasServerPSK() as $line){ ?>
                                                 <option value="<?php #echo $line["ipserver"]; ?>"><?php #echo $line["servername"]; ?></option>
                                                 <?php #} ?>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-sm-2 control-label" for="Macro_IP">Macro IP 2</label>
                                        <div class="col-sm-10">
                                            <select class ="form-control" name="portInt">
                                                    <?php // Parcours du tableau de données retourné par la classe VPN - PSK
                                                 # foreach($vpnServerPSK->getDatasServerPSK() as $line){ ?>
                                                 <option value="<?php #echo $line["ipserver"]; ?>"><?php #echo $line["servername"]; ?></option>
                                                 <?php #} ?>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-sm-2 control-label" for="button"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-success" id="macro"><i class="glyphicon glyphicon-plus"></i> Ajouter </button>
                                        </div>
                                    </div>
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <?php
            include __DIR__."/../../global/view/footer.php"
            ?>
        </body>
        </html>