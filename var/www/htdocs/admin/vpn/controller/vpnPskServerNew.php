<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 22/01/2015
 * Time: 17:04
 */

////////////////////////////////////
// CONTROLLER vpnPskServerNew.php //
////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/VpnPskServerModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable

$servername = htmlspecialchars($_POST['NewVPNserverPSK']);
$ipserver = htmlspecialchars($_POST['IPServerPSK']);
$iptunserver = htmlspecialchars($_POST['IPTunServer']);
$iptunclient = htmlspecialchars($_POST['IPTunClient']);
$port = htmlspecialchars($_POST['Port']);
$interface = htmlspecialchars($_POST['Interface']);

///////////////////////////////////////////////////

//echo 'ipserver:'; var_dump($ipserver);
//echo 'servername:'; var_dump($servername);
//echo 'iptunserver:'; var_dump($iptunserver);
//echo 'iptunclient:'; var_dump($iptunclient);
//echo 'port:'; var_dump($port);
//echo 'interface:'; var_dump($interface);
//die;

////////////////////////////////////////////////////


// Instanciation des objets VPN PSK

$vpnServerPSK = new VpnPskServerModel();
$vpnServerPSK->init();
$return = $vpnServerPSK->createServerPSK(
    $servername,
    $ipserver,
    $iptunserver,
    $iptunclient,
    $port,
    $interface
);
echo $return;

// TODO Appeler les class pf pour ouvrir les ports + NAT

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "Création du server $servername";
require_once __DIR__."/../view/vpn_done.php";


