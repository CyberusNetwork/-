<?php

///////////////////////////////////////
// CONTROLLER delete_dhcp_static.php //
///////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__ . "/../model/DhcpModel.php";
include_once __DIR__ . "/../../dns/model/DnsModel.php";

// Variable de session

$id = (htmlspecialchars($_GET['StaticID']));
$hostname = (htmlspecialchars($_GET['StaticName']));

// Instanciation de l'objet DHCP

$dns = new DnsModel();
$dhcp = new DhcpModel();

// Execution de la requête

$return = $dns->deleteDns($hostname);
$dhcp->deleteStaticIP($id,$hostname);
var_dump($return);

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "Suppression de l'IP fixe $hostname";
require_once __DIR__ . "/../view/dhcp_done.php";
