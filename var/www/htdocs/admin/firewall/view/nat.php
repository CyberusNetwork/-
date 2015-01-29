<!DOCTYPE html>
<html lang="fr">
<head>
    <title>NAT - Administration</title>
    <!-- Bootstrap core CSS -->
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
    <div class="container-fluid" >

        <!-- Header -->
        <div class="page-header">
            <h1>NAT <small><i>Ici, c'est magique !</i></small></h1>
        </div>

        <!-- Navigation bar -->
        <?php
        $class_firewall = "active";
        include __DIR__."/../../global/view/nav_bar.php"
        ?>

        <!-- Contents -->
        <p class="lead">Network Address Translation</p>
        <p>Ici on fait de la NAT : </p>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            </div>
            <?php
            include_once "macro.php"; 
            ?>

            <!-- NAT -->
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <b>NAT</b>
                        </a>
                    </h4>
                </div>
                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <!-- nat content-->
                        <!-- nat Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        <b>Liste de NAT</b>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <table id="Macro_Table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Actions</th>
                                            <th>Macro Interface</th>
                                            <th>Macro IP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!-- sql -->
                                   </tbody>
                               </table>
                           </div>
                       </div>
                       <!-- nat form -->
                       <p>
                        <form class="form-horizontal" id='macroForm' role="form" action="./firewall/index.php?page=nat" method="post">
                            <!-- Bouton qui supprime la nat -->
<!--                    <td>
                        <a href="./firewall/index.php?page=delete_macro=<?php echo $line["id"]; ?>" title="Supprime une nat"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
                    </td>
                -->
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="NewVPNClientPSK">Macro Interface</label>
                    <div class="col-sm-10">
                        <select class ="form-control" name="nomInterface">
                                            <?php // Parcours du tableau de données retourné par la classe VPN - PSK
                                           # foreach($vpnServerPSK->getDatasServerPSK() as $line){ ?>
                                           <option value="<?php #echo $line["ipserver"]; ?>"><?php #echo $line["servername"]; ?></option>
                                           <?php #} ?>
                                       </select>
                                   </div>
                               </div>
                               <br>
                               <div class="form-group">
                                <label class="col-sm-2 control-label" for="Macro_IP">Macro IP</label>
                                <div class="col-sm-10">
                                    <select class ="form-control" name="ip">
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