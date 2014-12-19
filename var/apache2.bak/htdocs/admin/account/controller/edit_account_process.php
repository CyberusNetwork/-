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

(include_once __DIR__ . "/../model/AccountModel.php");
(include_once __DIR__."/../../account/model/DataBaseModel.php");

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

$username = (htmlspecialchars($_POST['Username']));
$lastname = (htmlspecialchars($_POST['Lastname']));
$firstname = (htmlspecialchars($_POST['Firstname']));
$email = (htmlspecialchars($_POST['Email']));
$password = (htmlspecialchars($_POST['Password']));
$md5_password = md5($password);
$server = "localhost";


// TODO Vérification que les champs ne sont pas vide et de la double verif PWD



// Instanciation de l'objet NewAccount

$userid = $_SESSION['userid'];
$account = new AccountModel($userid);
$database = new DataBaseModel();

// Appel de la methode

$account->editUser(
    $username,
    $lastname,
    $firstname,
    $email,
    $password,
    $md5_password
);

$database->setUsername($username);
$database->editDB(
    $md5_password,
    $server
);

// Retour à la page principale

require_once __DIR__."/../view/edit_account_done.php";
