<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 22/01/2015
 * Time: 17:04
 */

///////////////////////////////////////
// CONTROLLER vpnPskServerEnable.php //
///////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/VpnPskServerModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable

$serverid = $_GET['ServerID'];
$serverip = $_GET['ServerIP'];

////////////////////////////////////////////

//echo 'serverID'; var_dump($serverid);
//echo 'serverIP'; var_dump($serverip);
//die;

/////////////////////////////////////////////


// Instanciation des objets VPN PSK et X509

$vpnServerPSK = new VpnPskServerModel();
$vpnServerPSK->init();
$return = $vpnServerPSK->enableServerPSK($serverid,$serverip);
echo $return;

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "Activation du server $serverip";
require_once __DIR__."/../view/vpn_done.php";


