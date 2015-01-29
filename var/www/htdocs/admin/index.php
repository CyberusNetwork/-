<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 27/08/2014
 * Time: 13:36
 */

include_once __DIR__."/global/sesame.php";

switch($_GET["app"]){
    case "dashboard":
        include_once "./dashboard/index.php";
        break;
    case "account":
        include_once "./account/index.php";
        break;
    case "firewall":
        include_once "./firewall/index.php";
        break;
    case "dns":
        include_once "./dns/index.php";
        break;
    case "dhcp":
        include_once "./dhcp/index.php";
        break;
    case "vpn":
        include_once "./vpn/index.php";
        break;

    default:
        include_once "./global/controller/index.php";
}

?>