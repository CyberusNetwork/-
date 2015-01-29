<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 27/08/2014
 * Time: 13:36
 */

include_once __DIR__."/../global/sesame.php";

switch($_GET["page"]){
    case "delete_dhcp_static":
        include_once "controller/delete_dhcp_static.php";
        break;
    case "new_dhcp_static":
        include_once "controller/new_dhcp_static.php";
        break;
    case "edit_dhcp_range":
        include_once "controller/edit_dhcp_range.php";
        break;

    default:
        include_once "controller/dhcp.php";
}
