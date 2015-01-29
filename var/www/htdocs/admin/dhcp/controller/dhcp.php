<?php

/////////////////////////
// CONTROLLER dhcp.php //
/////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour r�cup�rer les donn�es

include_once __DIR__ . "/../model/DhcpModel.php";

// Instanciation de l'objet DHCP

$dhcp = new DhcpModel();

// Execution de la requ�te

$dhcp->initStaticIP();
$dhcp->initRange('sis0');
$datasRangeSis0 = $dhcp->getDatasRange();
$dhcp->initRange('sis1');
$datasRangeSis1 = $dhcp->getDatasRange();


/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

require_once __DIR__ . "/../view/dhcp.php";
