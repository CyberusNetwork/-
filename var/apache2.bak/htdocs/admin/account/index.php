<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 27/08/2014
 * Time: 13:36
 */

include_once __DIR__."/../global/sesame.php";

switch($_GET["page"]){
    case "delete_account":
        include_once "controller/delete_account.php";
        break;

    case "delete_account_confirmed":
        include_once "controller/delete_account_process.php";
        break;

    case "edit_account":
        include_once "controller/edit_account.php";
        break;

    case "edit_account_confirmed":
        include_once "controller/edit_account_process.php";
        break;

    default:
        include_once "controller/account.php";
}

?>