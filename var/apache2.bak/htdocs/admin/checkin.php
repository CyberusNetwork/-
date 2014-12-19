<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 25/08/2014
 * Time: 19:58
 */

// /////////////////////////
// CONTROLLER checkin.php //
////////////////////////////

// Page de vérification du login et du mot de passe

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once "account/model/UserModel.php";
session_start();

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Récupération du USER via le login saisi

$login = $_POST['login'];
$password = $_POST['password'];
$crypted_password = md5($password);

//var_dump($login);
//var_dump($password);
//var_dump($crypted_password);

$user = new UserModel();

// Renvoi l'utilisateur s'il existe; renvoi null sinon
$usercheck = $user->checkUserByLogin($login);
if (!$usercheck)
{
    echo "Aucun utilisateur ne correspond a votre login";
} else {
    // vérification du mot de passe
    $checkpassword = $user->checkUserPassword($login, $crypted_password);
    if (!$checkpassword){
        echo "Mot de passe incorrect";
    } else {
        $user->init($login, $crypted_password);
        $_SESSION['userid'] = $user->getUserId();
        header('Location: index.php');
    }
}
