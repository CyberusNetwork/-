<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 23/01/2015
 * Time: 20:44
 */

/////////////////////////////////////
// CONTROLLER vpnX509ServerNew.php //
/////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/VpnX509ServerModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable

$servername = htmlspecialchars($_POST['NewVPNserverX509']);
$ipserver = htmlspecialchars($_POST['IPServerX509']);
$mask = htmlspecialchars($_POST['MaskX509']);
$port = htmlspecialchars($_POST['Port']);
$interface = htmlspecialchars($_POST['Interface']);

///////////////////////////////////////////////////

//echo 'ipserver:'; var_dump($ipserver);
//echo 'servername:'; var_dump($servername);
//echo 'mask:'; var_dump($mask);
//echo 'port:'; var_dump($port);
//echo 'interface:'; var_dump($interface);
//die;

////////////////////////////////////////////////////

// Instanciation des objets VPN PSK

$vpnServerX509 = new VpnX509ServerModel();
$vpnServerX509->init();
$return = $vpnServerX509->createServerX509(
    $servername,
    $ipserver,
    $mask,
    $port,
    $interface
);
echo $return;

// TODO Appeler les class pf pour ouvrir les ports + NAT

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "Création du server $servername";
require_once __DIR__."/../view/vpn_done.php";