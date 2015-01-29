<?php

////////////////////////////////////
// CONTROLLER new_dhcp_static.php //
////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour r�cup�rer les donn�es

include_once __DIR__ . "/../model/DhcpModel.php";
include_once __DIR__ . "/../../dns/model/DnsModel.php";

// Variable de session

$hostname = (htmlspecialchars($_POST['NewHostname']));
$address_mac = (htmlspecialchars($_POST['AddressMAC']));
$address_ip = (htmlspecialchars($_POST['AddressIP']));
$type = 'A';

// Instanciation de l'objet DNS et DHCP

$dhcp = new DhcpModel();
$dns = new DnsModel();

// Execution de la requ�te
if (!$dhcp->checkStaticIP($address_mac))
    {
        $dhcp->newStaticIP($hostname, $address_ip, $address_mac);
        $dns->createDns($hostname, $type, $address_ip);
    } else {
        echo 'Adresse Mac d�j� pr�sente dans la base';
    }


/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

$action = "Ajout de l'IP fixe $hostname, $address_ip, $address_mac";
require_once __DIR__ . "/../view/dhcp_done.php";


