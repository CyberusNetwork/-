<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 22/01/2015
 * Time: 22:56
 */

////////////////////////////////////
// CONTROLLER vpnX509ClientNew.php //
////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/VpnX509ClientModel.php";
include_once __DIR__."/../model/VpnX509ServerModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable

$clientname = htmlspecialchars($_POST['ClientNameX509']);
$ipserver = htmlspecialchars($_POST['IPServerX509']);
$clientemail = htmlspecialchars($_POST['ClientEmail']);

// Instanciation des objets VPN PSK

$vpnServerX509 = new VpnX509ServerModel();
$vpnServerX509->init();
$vpnServerX509->setServerX509($ipserver);
$datas = $vpnServerX509->getSelectedServerX509();
$servername = $datas['servername'];
$mask = $datas['mask'];
$port = $datas['port'];
$interface = $datas['interface'];

///////////////////////////////////////////////////

//echo 'ipserver:'; var_dump($ipserver);
//echo 'clientname:'; var_dump($clientname);
//echo 'clientname'; var_dump($clientemail);
//echo 'datas:'; var_dump($datas);
//echo 'servername:'; var_dump($servername);
//echo 'mask:'; var_dump($mask);
//echo 'port:'; var_dump($port);
//echo 'interface:'; var_dump($interface);
//die;

////////////////////////////////////////////////////


$vpnClientPSK = new VpnX509ClientModel();
$return = $vpnClientPSK->createClientX509(
    $servername,
    $ipserver,
    $mask,
    $port,
    $interface
);
echo $return;


/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "Création du client $clientname";
require_once __DIR__."/../view/vpn_done.php";
