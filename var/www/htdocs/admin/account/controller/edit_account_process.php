<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 29/08/2014
 * Time: 00:21
 */

//////////////////////////////////////////
// CONTROLLER - new_account_process.php //
//////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__ . "/../model/AccountModel.php";


/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

$username = htmlspecialchars($_POST['Username']);
$lastname = htmlspecialchars($_POST['Lastname']);
$firstname = htmlspecialchars($_POST['Firstname']);
$email = htmlspecialchars($_POST['Email']);
$password = htmlspecialchars($_POST['Password']);
$md5_password = md5($password);
$server = "localhost";

// Instanciation de l'objet NewAccount

$account = new AccountModel();

// Appel de la methode account

$account->editUser(
    $username,
    $lastname,
    $firstname,
    $email,
    $password,
    $md5_password
);


// Retour à la page principale

require_once __DIR__."/../view/edit_account_done.php";
