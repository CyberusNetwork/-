<?php
include_once("Vue/pf.html");
include_once("Vue/loadBalancing.html");

if(empty($_POST['nomMacro']) || empty($_POST['fonction']) ) 
	{
		echo "Champs vides";
	}
else
	{
		echo "Enregistrement";
	}
?>