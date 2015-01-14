<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 27/08/2014
 * Time: 21:15
 */

include_once __DIR__."/../global/sesame.php";

switch($_GET["page"]){
    default:
        include_once "controller/dashboard.php";
}
?>