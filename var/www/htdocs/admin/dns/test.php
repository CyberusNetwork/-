<?php

$domain = "test3.cbnet.itinet.fr";
$type = "A";
$target = "10.8.100.13";
$local = "local_data";

$sh_domain = escapeshellcmd($domain);
$sh_type = escapeshellcmd($type);
$sh_target = escapeshellcmd($target);
$command = "sudo unbound-control local_data $sh_domain $sh_type $sh_target";


$sh_req_add_sd = shell_exec($command);
$test = shell_exec("uname -a");

//var_dump($sh_domain);
//var_dump($sh_type);
//var_dump($sh_target);

var_dump($command);
var_dump($test);
var_dump($sh_req_add_sd);
?>
