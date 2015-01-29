<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 22/01/2015
 * Time: 17:04
 */

////////////////////////////////////////
// CONTROLLER vpnPskServerDisable.php //
////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour r�cup�rer les donn�es

include_once __DIR__."/../model/VpnPskServerModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des donn�es et des informations diverses

// Variable

$serverid = $_GET['ServerID'];
$serverip = $_GET['ServerIP'];

////////////////////////////////////////////

//echo 'serverID'; var_dump($serverid);
//echo 'serverIP'; var_dump($serverip);


/////////////////////////////////////////////

// Instanciation des objets VPN PSK

$vpnServerPSK = new VpnPskServerModel();
$vpnServerPSK->init();
$return = $vpnServerPSK->disableServerPSK($serverid,$serverip);
echo $return;

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "D�sactivation du server $serverip";
require_once __DIR__."/../view/vpn_done.php";

