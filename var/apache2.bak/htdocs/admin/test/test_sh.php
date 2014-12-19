<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 31/08/2014
 * Time: 18:20
 */


$password ="test3";
$shell="./dovecot_pwd_crypt.sh $password";
$crypted_password = exec($shell);

echo 'Password';
var_dump($password);
echo 'Shell';
var_dump($shell);
echo 'Crypted Password';
var_dump($crypted_password);