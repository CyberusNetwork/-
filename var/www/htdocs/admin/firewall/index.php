<?php

include_once __DIR__."/../global/sesame.php";

switch($_GET["page"]){
    case "add_macro":
        include_once "view/add_macro.php";
        break;    
    case "macro":
        include_once "view/macro.php";
        break;
    case "table":
        include_once "view/table.php";
        break;
    case "add_table":
        include_once "view/add_table.php";
        break;    
    case "nat":
        include_once "view/nat.php";
        break;  
    case "redirection":
        include_once "view/redirection.php";
        break;                  
    case "qos":
        include_once "view/qos.php";
        break;  
    case "regle":
        include_once "view/regle.php";
        break;  
    case "loadbalancing":
        include_once "view/loadbalancing.php";
        break;

    default:
        include_once "view/firewall.php";
}
