<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 28/08/2014
 * Time: 00:10
 */

//////////////////////////////////
// CONTROLLER - new_account.php //
//////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

(include_once __DIR__ . "/../model/NewAccountModel.php");

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

$username = (htmlspecialchars($_POST['Username']));
$lastname = (htmlspecialchars($_POST['Lastname']));
$firstname = (htmlspecialchars($_POST['Firstname']));
$email = (htmlspecialchars($_POST['Email']));
$password = (htmlspecialchars($_POST['Password']));
$crypted_password = md5($password);


// Instanciation de l'objet NewAccount

$new_account = new NewAccountModel();

// Appel de la methode

 $new_account->createUser(
    $username,
    $lastname,
    $firstname,
    $email,
    $password,
    $crypted_password);

$new_account->setUsername($username);
$userid = $new_account->getUserId();


// Retour à la page principale

require_once __DIR__ . "/../view/new_account_done.php";

?>