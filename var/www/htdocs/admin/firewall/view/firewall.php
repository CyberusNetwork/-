<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Firewall - Administration</title>
	<!-- Bootstrap core CSS -->
	<?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
	<div class="container-fluid" >

		<!-- Header -->
		<div class="page-header">
			<h1>Vos option de firewall <small><i>À vous de jouer !</i></small></h1>
		</div>

		<!-- Navigation bar -->
		<?php
		$class_firewall = "active";
		include __DIR__."/../../global/view/nav_bar.php"
		?>

		<!-- Contents -->
		<p class="lead">Vos option de firewall</p>
		<p>Choissisez l'une des options proposées : </p>

		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
			<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingTwo">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTre" aria-expanded="false" aria-controls="collapseTre">
							<b>Macro</b>
						</a>
						<a href="../firewall/index.php?page=add_macro">
							<span style="float:right;" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</a>
					</h4>
				</div>
				<div id="collapseTre" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTree">
					<div class="panel-body">
						Permet d'ajouter des macros avec fonctions.
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingTwo">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							<b>Règle de Filtrages</b>
						</a>
						<a href="../firewall/index.php?page=regle">
							<span style="float:right;" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					<div class="panel-body">
						Permet de laisser passer ou de bloquer les paquets.
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingTwo">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTree" aria-expanded="false" aria-controls="collapseTree">
							<b>Redirection</b>
						</a>
						<a href="../firewall/index.php?page=redirection">
							<span style="float:right;" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</a>
					</h4>
				</div>
				<div id="collapseTree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTree">
					<div class="panel-body">
						Permet de faire de la redirection de port.
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingTwo">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
							<b>Règle de QOS</b>
						</a>
						<a href="../firewall/index.php?page=qos">
							<span style="float:right;" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</a>
					</h4>
				</div>
				<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
					<div class="panel-body">
						Permet de faire de la QOS.
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingTwo">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
							<b>Table</b>
						</a>
						<a href="../firewall/index.php?page=add_table">
							<span style="float:right;" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</a>
					</h4>
				</div>
				<div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
					<div class="panel-body">
						Permet de rentrer des IP dans une table dynamique !
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingTwo">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
							<b>NAT</b>
						</a>
						<a href="../firewall/index.php?page=nat">
							<span style="float:right;" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</a>
					</h4>
				</div>
				<div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
					<div class="panel-body">
						Permet d'associer, vos adresse ip privé à une adresse ip public.
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingTwo">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
							<b>Load Balancing</b>
						</a>
						<a href="../firewall/index.php?page=loadbalancing">
							<span style="float:right;" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</a>
					</h4>
				</div>
				<div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
					<div class="panel-body">
						Permet de faire de la répartition de charge entre deux interface.
					</div>
				</div>
			</div>
			<br>
		</div>
		<!-- footer -->
		<?php
		include __DIR__."/../../global/view/footer.php"
		?>
	</body>
	</html>