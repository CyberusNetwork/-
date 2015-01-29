<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 22/01/2015
 * Time: 22:56
 */

///////////////////////////////////////
// CONTROLLER vpnPskClientDelete.php //
///////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/VpnX509ClientModel.php";


/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable

$clientname = htmlspecialchars($_GET['ClientName']);
$ipserver = htmlspecialchars($_GET['IPServer']);
$ipclient = htmlspecialchars($_GET['ClientIP']);


///////////////////////////////////////

//var_dump($clientname);
//var_dump($ipserver);
//var_dump($ipclient);
//die;

///////////////////////////////////////

// Instanciation des objets VPN PSK et X509

$vpnClientX509 = new VpnX509ClientModel();
$vpnClientX509->init();

$return = $vpnClientX509->deleteClientX509($id, $ipserver, $clientname);
echo $return;

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "Suppression du client $clientname";
require_once __DIR__."/../view/vpn_done.php";
