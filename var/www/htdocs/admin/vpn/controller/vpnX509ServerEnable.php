<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 23/01/2015
 * Time: 20:44
 */

////////////////////////////////////////
// CONTROLLER vpnX509ServerEnable.php //
////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/VpnX509ServerModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable

$serverid = $_GET['ServerID'];
$serverip = $_GET['ServerIP'];

///////////////////////////////////////

//var_dump($serverid);
//var_dump($serverip);
//die;

///////////////////////////////////////


// Instanciation des objets VPN PSK et X509

$vpnServerX509 = new VpnX509ServerModel();
$vpnServerX509->init();
$return = $vpnServerX509->enableServerX509($serverid,$serverip);
echo $return;

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "Activation du server $serverip";
require_once __DIR__."/../view/vpn_done.php";