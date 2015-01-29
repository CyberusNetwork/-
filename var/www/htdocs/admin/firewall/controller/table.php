<?php
include_once("Vue/pf.html");
include_once("Vue/table.html");

if(empty($_POST['nomTable'])) 
	{
		echo "Champs Vide";
	}
else 
	{
		echo "enregistrement";
	}
?>