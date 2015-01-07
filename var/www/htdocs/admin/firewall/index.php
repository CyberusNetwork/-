<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 26/12/2014
 * Time: 17:22
 */

include_once __DIR__."/../global/sesame.php";

switch($_GET["page"]){
    case "NewPF":
        include_once "controller/new_pf_done.php";
        break;
    case "DelPF":
        include_once "controller/del_pf_done.php";
        break;
    default:
        include_once "controller/pf.php";
}
?>