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

$username = (htmlspecialchars($_POST['Username']));
$lastname = (htmlspecialchars($_POST['Lastname']));
$firstname = (htmlspecialchars($_POST['Firstname']));
$email = (htmlspecialchars($_POST['Email']));
$password = (htmlspecialchars($_POST['Password']));
$md5_password = md5($password);
$server = "localhost";

var_dump($username);
var_dump($lastname);
var_dump($firstname);
var_dump($email);
var_dump($password);
var_dump($md5_password);
var_dump($server);

// Instanciation de l'objet NewAccount

$flaguserid = $_GET['userid'];
$account = new AccountModel();
var_dump($flaguserid);

// Appel de la methode account
die;
$account->editUser(
    $flaguserid,
    $username,
    $lastname,
    $firstname,
    $email,
    $password,
    $md5_password
);


// Retour à la page principale

require_once __DIR__."/../view/edit_account_done.php";
