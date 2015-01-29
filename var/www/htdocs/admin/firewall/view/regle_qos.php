<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
    </div>
    <!-- Règles de Filtrages -->
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseA" aria-expanded="false" aria-controls="collapseA">
                    <b>R&#232gles de filtrage QOS</b>
                </a>
            </h4>
        </div>
        <div id="collapseA" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <!-- Règles de Filtrages content-->
                <!-- Règles de Filtrages Table -->
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapseB" aria-expanded="false" aria-controls="collapseB">
                                <b>Liste de filtrage de QOS</b>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseB" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <table id="Macro_Table" class="table">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>All</th>
                                    <th>Option</th>
                                    <th>IN/OUT</th>
                                    <th>Macro Interface</th>
                                    <th>Proto</th>
                                    <th>Macro Port</th>
                                    <th>Table</th>
                                    <th>Parent</th>
                                    <th>Enfant</th>
                                    <th>Option Enfant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- sql -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Règles de Filtrages form -->
                <p>
                    <form class="form-horizontal" id='macroForm' role="form" action="./firewall/index.php?page=regle" method="post">
                        <!-- Bouton qui supprime la Règles de Filtrages -->
                        <br>
                        <div class="form-group" id="regleID">
                            <label class="col-sm-2 control-label" for="regle">Type de r&#232gle</label>
                            <div id="regleID" class="col-sm-10">
                                <select id="regle" class ="form-control" name="regle" onChange="showType(this)">
                                    <option></option>
                                    <option value="quickPass" >Quick Pass queue</option>
                                    <option value="pass">Pass queue</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="typeID">
                            <label class="col-sm-2 control-label" for="type"> Choisir </label> 
                            <div id="typeID" class="col-sm-10">
                                <select id="type" class ="form-control" name="type" onChange="showParam(this)">
                                    <option></option>
                                    <option value="all" >ALL</option>
                                    <option value="tcp" >TCP</option>
                                    <option value="udp" >UDP</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="paramGodPassID" style="display:none">
                            <p align="center">
                                <b>Pass queue mode GOD</b> 
                            </p>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paramGodPassID">Macro Interface</label>
                                <div class="col-sm-10">
                                    <select class ="form-control" name="interface">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paramGodPassID">Macro Port</label>
                                <div class="col-sm-10">
                                    <select class ="form-control" name="port">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paramGodPassID">Table</label>
                                <div class="col-sm-10">
                                    <select class ="form-control" name="table">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paramGodPassID">Nom Parent</label>
                                <div class="col-sm-10">
                                    <select class ="form-control" name="interface">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paramGodPassID">Nom Enfant ou l'option de enfant</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="child" placeholder="(max : 20 caractères)" required pattern="^[_\.]{1,20}$">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="paramPassID" style="display:none">
                            <p align="center">
                                <b>Pass queue Table</b> 
                            </p>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paramPassID">IN/OUT</label>
                                <div class="col-sm-10">
                                    <select class ="form-control" name="inOut">
                                        <option></option>
                                        <option>In</option>
                                        <option>Out</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paramPassID">Macro Interface</label>
                                <div class="col-sm-10">
                                    <select class ="form-control" name="interface">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paramPassID">Macro Port</label>
                                <div class="col-sm-10">
                                    <select class ="form-control" name="port">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paramPassID">Table</label>
                                <div class="col-sm-10">
                                    <select class ="form-control" name="table">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paramGodPassID">Nom Parent</label>
                                <div class="col-sm-10">
                                    <select class ="form-control" name="interface">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paramGodPassID">Nom Enfant ou l'option de enfant</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="child" placeholder="(max : 20 caractères)" required pattern="^[_\.]{1,20}$">
                                </div>
                            </div>

                            <div id="paramGodBlockID" style="display:none"></div>
                            <div id="paramBlockID" style="display:none"></div>
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