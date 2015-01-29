<?php

include_once __DIR__."/../global/sesame.php";

switch($_GET["page"]){

    case "enable_vpn_server_psk":
        include_once "controller/vpnPskServerEnable.php";
        break;
    case "disable_vpn_server_psk":
        include_once "controller/vpnPskServerDisable.php";
        break;
    case "delete_vpn_server_psk":
        include_once "controller/vpnPskServerDelete.php";
        break;
    case "new_vpn_server_psk":
        include_once "controller/vpnPskServerNew.php";
        break;
    case "delete_vpn_client_psk":
        include_once "controller/vpnPskClientDelete.php";
        break;
    case "new_vpn_client_psk":
        include_once "controller/vpnPskClientNew.php";
        break;
    case "enable_vpn_server_X509":
        include_once "controller/vpnX509ServerEnable.php";
        break;
    case "disable_vpn_server_X509":
        include_once "controller/vpnX509ServerDisable.php";
        break;
    case "delete_vpn_server_X509":
        include_once "controller/vpnX509ServerDelete.php";
        break;
    case "new_vpn_server_X509":
        include_once "controller/vpnX509ServerNew.php";
        break;
    case "delete_vpn_client_X509":
        include_once "controller/vpnX509ClientDelete.php";
        break;
    case "new_vpn_client_X509":
        include_once "controller/vpnX509ClientNew.php";
        break;
    default:
        include_once "controller/vpn.php";
}
