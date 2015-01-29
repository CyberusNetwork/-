<?php

////////////////////////
// CONTROLLER vpn.php //
////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/VpnPskServerModel.php";
include_once __DIR__."/../model/VpnX509ServerModel.php";
include_once __DIR__."/../model/VpnPskClientModel.php";
include_once __DIR__."/../model/VpnX509ClientModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable de session

$userid = $_SESSION['userid'];

// Instanciation des objets VPN PSK et X509

$vpnServerPSK = new VpnPskServerModel();
$vpnServerX509 = new VpnX509ServerModel();
$vpnClientPSK = new VpnPskClientModel();
$vpnClientX509 = new VpnX509ClientModel();

$vpnServerPSK->init();
$vpnServerX509->init();
$vpnClientPSK->init();
$vpnClientX509->init();

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

require_once __DIR__."/../view/vpn.php";
