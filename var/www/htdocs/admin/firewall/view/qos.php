<!DOCTYPE html>
<html lang="fr">
<head>
    <title>QOS - Administration</title>
    <!-- Bootstrap core CSS -->
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
    <script type="text/javascript" src="./../js/regle.js"></script>
</head>
<body>
    <div class="container-fluid" >

        <!-- Header -->
        <div class="page-header">
            <h1> QOS <small><i>On limite la bande passante !</i></small></h1>
        </div>

        <!-- Navigation bar -->
        <?php
        $class_firewall = "active";
        include __DIR__."/../../global/view/nav_bar.php"
        ?>
        <!-- Contents -->
        <p class="lead">Qualité de service</p>
        <p>Ici il n'y a jamais d'embouteillage : </p>
        <?php
        include_once "macro.php"; 
        ?>
        <!-- Parent -->
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <b>QOS</b>
                    </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <!-- qos content-->
                    <!-- Parent -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">

                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <b>Ajouter un parent</b>
                                </a>
                            </h4>
                        </div>

                        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <b>Liste des parents</b>
                                    </a>
                                </h4>
                            </div>

                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <table id="qos" class="table">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Nom du parent</th>
                                            <th>Macro Interface</th>
                                            <th>Bande Passante</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- sql -->
                                    </tbody>
                                </table>
                            </div>

                            <form class="form-horizontal" id='qosForm' role="form" action="./firewall/index.php?page=qos" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="parent">Nom du parent</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="parent" placeholder="Nom (max : 20 caractères)" required pattern="^[_\.]{1,20}$">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="interface">Macro Interface</label>
                                    <div class="col-sm-10">
                                        <select class ="form-control" name="interface">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="bp">Bande Passante</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bp" placeholder="15k, 15M, 15G Max 15G">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="button"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success" id="qos"><i class="glyphicon glyphicon-plus"></i> Ajouter </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Défaut child -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">

                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    <b>Ajouter un enfant par défaut</b>
                                </a>
                            </h4>
                        </div>

                        <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        <b>Liste des enfants par défaut</b>
                                    </a>
                                </h4>
                            </div>

                            <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <table id="qos" class="table">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Nom du parent</th>
                                            <th>Nom de l'enfant par défaut</th>
                                            <th>Bande Passante</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- sql -->
                                    </tbody>
                                </table>
                            </div>

                            <form class="form-horizontal" id='qosForm' role="form" action="./firewall/index.php?page=qos" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="parent">Parent</label>
                                    <div class="col-sm-10">
                                        <select class ="form-control" name="parent">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="bp">Nom enfant par défaut</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="child_def" placeholder="Nom (max : 20 caractères)" required pattern="^[_\.]{1,20}$">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="interface">Macro Interface</label>
                                    <div class="col-sm-10">
                                        <select class ="form-control" name="interface">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="bp">Bande Passante</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bp" placeholder="15k, 15M, 15G Max 15G">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="button"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success" id="qos"><i class="glyphicon glyphicon-plus"></i> Ajouter </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Child -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">

                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    <b>Ajouter un enfant</b>
                                </a>
                            </h4>
                        </div>

                        <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                        <b>Liste des enfants</b>
                                    </a>
                                </h4>
                            </div>

                            <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <table id="qos" class="table">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Nom du parent</th>
                                            <th>Nom de l'enfant</th>
                                            <th>Bande Passante</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- sql -->
                                    </tbody>
                                </table>
                            </div>

                            <form class="form-horizontal" id='qosForm' role="form" action="./firewall/index.php?page=qos" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="parent">Parent</label>
                                    <div class="col-sm-10">
                                        <select class ="form-control" name="parent">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="bp">Nom enfant</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="child" placeholder="Nom (max : 20 caractères)" required pattern="^[_\.]{1,20}$">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="bp">Bande Passante</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bp" placeholder="15k, 15M, 15G Max 15G">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="button"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success" id="qos"><i class="glyphicon glyphicon-plus"></i> Ajouter </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- child option -->                
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">

                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                    <b>Ajouter une option à un enfant</b>
                                </a>
                            </h4>
                        </div>

                        <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                        <b>Liste d'options enfants</b>
                                    </a>
                                </h4>
                            </div>

                            <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <table id="qos" class="table">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Nom du parent</th>
                                            <th>Nom de l'enfant</th>
                                            <th>Nom de l'option enfant</th>
                                            <th>Bande Passante</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- sql -->
                                    </tbody>
                                </table>
                            </div>

                            <form class="form-horizontal" id='qosForm' role="form" action="./firewall/index.php?page=qos" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="parent">Parent</label>
                                    <div class="col-sm-10">
                                        <select class ="form-control" name="parent">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="child">Enfant</label>
                                    <div class="col-sm-10">
                                        <select class ="form-control" name="child">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="bp">Nom de l'option enfant</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="child_option" placeholder="Nom (max : 20 caractères)" required pattern="^[_\.]{1,20}$">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="bp">Bande Passante</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bp" placeholder="15k, 15M, 15G Max 15G">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="button"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success" id="qos"><i class="glyphicon glyphicon-plus"></i> Ajouter </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application QOS -->
        <?php
        include_once "regle_qos.php"; 
        ?>        
    </div>
</div>