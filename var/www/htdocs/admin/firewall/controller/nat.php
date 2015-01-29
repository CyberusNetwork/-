<?php

include_once("Vue/pf.html");
include_once("Vue/nat.html");

// include_once("Vue/macro.html");

if(empty($_POST['nomInterface']) || empty($_POST['ip']) )
	{
		echo "Champs Vide";
	}
else 
	{
		$pattern = '/[0-2]?[0-9]?[0-9]\.[0-2]?[0-9]?[0-9]\.[0-2]?[0-9]?[0-9]\.[0-2]?[0-9]?[0-9]/';
		if (!preg_match($pattern, $_POST['ip'], $matches)) 
			{
				echo "Ip non valide";
			}
		else 
			{
				echo "Enregistrement";
			}
	}
?>