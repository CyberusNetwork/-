<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 28/08/2014
 * Time: 21:10
 */

switch($_GET["page"]){
    case "new":
        include_once "./global/view/new_account.php";
        break;
    case "processing":
        include_once "./global/controller/new_account_process.php";
        break;
    default:
        include_once "error.php";
}
?>

