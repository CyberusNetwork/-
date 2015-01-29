<?php
include_once("Vue/pf.html");
include_once("Modele/macro.php");

$pf = new pfModel();
$pf->init();

if(empty($_POST['nomMacro']) || empty($_POST['fonction']) ) 
	{
		echo "Champs vides"; 
	}
	else 
	{
		// ajoutMacro($_POST['nomMacro'], $_POST['fonction']);
		echo "enregistrement";
		$pf->new_pf_macro($_POST['nomMacro'], $_POST['fonction']);
	}

include_once("Vue/macro.html");
?>