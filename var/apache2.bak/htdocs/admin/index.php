<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 27/08/2014
 * Time: 13:36
 */

include_once __DIR__."/global/sesame.php";

switch($_GET["app"]){
    case "account":
        include_once "./account/index.php";
        break;
    case "dns":
        include_once "./dns/index.php";
        break;
    case "mail":
        include_once "./mail/index.php";
        break;
    case "site":
        include_once "./site/index.php";
        break;
    default:
        include_once "./global/controller/index.php";
}

?>