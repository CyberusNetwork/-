<?php

/////////////////////////
// CONTROLLER dhcp.php //
/////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__ . "/../model/DhcpModel.php";

// Variable de session

$interface = htmlspecialchars($_POST['Interface']);
$ipstart = htmlspecialchars($_POST['IPStart']);
$ipend = htmlspecialchars($_POST['IPEnd']);

var_dump($interface);
var_dump($ipstart);
var_dump($ipend);

// Instanciation de l'objet DHCP

$dhcp = new DhcpModel();

// Execution de la requête

$dhcp->editRange($interface, $ipstart, $ipend);

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "Edition de la plage IP de $interface, $ipstart, $ipend ";
require_once __DIR__ . "/../view/dhcp_done.php";
