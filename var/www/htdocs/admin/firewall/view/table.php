    <!-- Table -->
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <b>Tables</b>
                </a>
            </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <!-- Table content-->
                <!-- Table Table -->
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <b>Liste des Tables</b>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <table id="Table" class="table">
                            <thead>
                                <tr>
                                    <th>Nom de la Table</th>
                                    <th>Fonction de la Table</th>
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
                                <b>Ajouter une table</b>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <p>
                            <form class="form-horizontal" id='TableForm' role="form" action="./firewall/index.php?page=table" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="name_Table">Nom de la Table</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nomTable" placeholder="Nom (max : 20 caractères)" required pattern="^[_\.]{1,20}$">
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
                <!-- Table form -->
                <p>
                    <form class="form-horizontal" id='TableForm' role="form" action="./firewall/index.php?page=table" method="post">
                        <!-- Bouton qui supprime la table -->
<!--                    <td>
                        <a href="./firewall/index.php?page=delete_table=<?php echo $line["id"]; ?>" title="Supprime une table"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
                    </td>
                -->

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="nomTable">Nom de la Table</label>
                    <div class="col-sm-10">
                        <select class ="form-control" name="nomTable">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="IPServer">IP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ip_table" placeholder="192.168.13.0" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
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
</div>