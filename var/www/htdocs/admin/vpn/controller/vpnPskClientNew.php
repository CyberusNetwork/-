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
include_once __DIR__."/../model/VpnPskServerModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable

$ipserver = htmlspecialchars($_POST['IPServerPSK']);
$clientname = htmlspecialchars($_POST['NewClientPSK']);
$ipclient = htmlspecialchars($_POST['IPClientPSK']);
$clientemail = htmlspecialchars($_POST['ClientEmail']);

// Instanciation des objets VPN PSK

$vpnServerPSK = new VpnPskServerModel();
$vpnServerPSK->init();
$vpnServerPSK->setServerPSK($ipserver);
$datas = $vpnServerPSK->getSelectedServerPSK();
$servername = $datas['servername'];
$iptunserver = $datas['tunserver'];
$iptunclient = $datas['tunclient'];
$port = $datas['port'];
$interface = $datas['interface'];


///////////////////////////////////////////////////

//echo 'ipserver:'; var_dump($ipserver);
//echo 'clientname:'; var_dump($clientname);
//echo 'ipclient:'; var_dump($ipclient);
//echo 'clientname'; var_dump($clientemail);
//echo 'datas:'; var_dump($datas);
//echo 'servername:'; var_dump($servername);
//echo 'iptunserver:'; var_dump($iptunserver);
//echo 'iptunclient:'; var_dump($iptunclient);
//echo 'port:'; var_dump($port);
//echo 'interface:'; var_dump($interface);
//die;

////////////////////////////////////////////////////

$vpnClientPSK = new VpnPskClientModel();
$return = $vpnClientPSK->createClientPSK(
    $servername,
    $clientname,
    $ipserver,
    $iptunserver,
    $iptunclient,
    $port,
    $interface
);
echo $return;


/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "Création du compte client $clientname";
require_once __DIR__."/../view/vpn_done.php";
