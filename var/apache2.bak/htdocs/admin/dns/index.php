<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 27/08/2014
 * Time: 21:15
 */

include_once __DIR__."/../global/sesame.php";

switch($_GET["page"]){
    case "delete_dns":
        include_once "controller/delete_dns_process.php";
        break;
    case "new_dns":
        include_once "controller/new_dns_process.php";
        break;

    default:
        include_once "controller/dns.php";
}
?>