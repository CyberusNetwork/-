<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 12/01/2015
 * Time: 15:58
 */

$interface = "sis0";
$test = exec("ifconfig $interface", $out);
var_dump ($out);

