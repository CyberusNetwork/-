<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 22/01/2015
 * Time: 22:56
 */

////////////////////////////////////
// CONTROLLER vpnPskClientNew.php //
////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/VpnPskClientModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable

$id = $_GET['ClientID'];
$ipserver = $_GET['IPServer'];
$clientname = $_GET['ClientName'];

///////////////////////////////////////

//echo 'id'; var_dump($id);
//echo 'ipserver'; var_dump($ipserver);
//echo 'clientname'; var_dump($clientname);
//die;

///////////////////////////////////////


// Instanciation des objets VPN PSK et X509

$vpnClientPSK = new VpnPskClientModel();
$vpnClientPSK->init();
$return = $vpnClientPSK->deleteClientPSK($id,$ipserver,$clientname);
echo $return;

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "Suppression de compte client $clientname";
require_once __DIR__."/../view/vpn_done.php";


