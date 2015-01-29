<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Règles de Filtrages - Administration</title>
	<!-- Bootstrap core CSS -->
	<?php include_once __DIR__ . "/../../css/header.php"; ?>
    <script type="text/javascript" src="./../js/regle.js"></script>
	</head>
	<body>
		<div class="container-fluid" >

			<!-- Header -->
			<div class="page-header">
				<h1>Règles de Filtrages <small><i>En quick ou non, ça pass ou ça bloque !</i></small></h1>
			</div>

            <!-- Navigation bar -->
            <?php
            $class_firewall = "active";
            include __DIR__."/../../global/view/nav_bar.php"
            ?>

				<!-- Contents -->
				<p class="lead">Tu veux passer ou bloquer des paquets, c'est ici !</p>
				<p>Ici on applique les règles de filtrages : </p>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					</div>
					<?php
					include_once "macro.php"; 
					include_once "table.php"; 
					?>
					<!-- Règles de Filtrages -->
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingTwo">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
									<b>R&#232gles de Filtrages</b>
								</a>
							</h4>
						</div>
						<div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">
								<!-- Règles de Filtrages content-->
								<!-- Règles de Filtrages Table -->
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingTwo">
										<h4 class="panel-title">
											<a class="collapsed" data-toggle="collapse" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
												<b>Liste de R&#232gles de Filtrages</b>
											</a>
										</h4>
									</div>
									<div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
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
<!--                    <td>
												<a href="./firewall/index.php?page=delete_macro=<?php echo $line["id"]; ?>" title="Supprime une Règles de Filtrages"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
										</td>
									-->
									<br>
									<div class="form-group" id="regleID">
										<label class="col-sm-2 control-label" for="regle">Type de r&#232gle</label>
										<div id="regleID" class="col-sm-10">
											<select id="regle" class ="form-control" name="regle" onChange="showType(this)">
												<option></option>
												<option value="quickPass" >Quick Pass</option>
												<option value="pass" >Pass</option>
												<option value="quickBlock" >Quick Block</option>
												<option value="block" >Block</option>
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
											<b>Pass GOD</b> 
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
									</div>

									<div class="form-group" id="paramPassID" style="display:none">
										<p align="center">
											<b>Pass Table</b> 
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
									</div>

									<div class="form-group" id="paramGodBlockID" style="display:none">
										<p align="center">
											<b>Block god</b> 
										</p>
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="paramGodBlockID">Macro Interface</label>
											<div class="col-sm-10">
												<select class ="form-control" name="interface">
													<option></option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="paramGodBlockID">Macro Port</label>
											<div class="col-sm-10">
												<select class ="form-control" name="port">
													<option></option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="paramGodBlockID">Table</label>
											<div class="col-sm-10">
												<select class ="form-control" name="table">
													<option></option>
												</select>
											</div>
										</div>
									</div>

									<div class="form-group" id="paramBlockID" style="display:none">
										<p align="center">
											<b>Block</b> 
										</p>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="paramBlockID">IN/OUT</label>
											<div class="col-sm-10">
												<select class ="form-control" name="inOut">
													<option></option>
													<option>In</option>
													<option>Out</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="paramBlockID">Macro Interface</label>
											<div class="col-sm-10">
												<select class ="form-control" name="interface">
													<option></option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="paramBlockID">Macro Port</label>
											<div class="col-sm-10">
												<select class ="form-control" name="port">
													<option></option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="paramBlockID">Table</label>
											<div class="col-sm-10">
												<select class ="form-control" name="table">
													<option></option>
												</select>
											</div>
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
			<!-- footer -->
			<?php
			include __DIR__."/../../global/view/footer.php"
			?>
		</body>
		</html>