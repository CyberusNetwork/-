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
(include_once __DIR__ . "/../../site/model/HostModel.php");
(include_once __DIR__ . "/../../dns/model/DnsModel.php");
(include_once __DIR__ . "/../../mail/model/MailModel.php");
(include_once __DIR__ . "/../../account/model/DataBaseModel.php");

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

$username = (htmlspecialchars($_POST['Username']));
$lastname = (htmlspecialchars($_POST['Lastname']));
$firstname = (htmlspecialchars($_POST['Firstname']));
$email = (htmlspecialchars($_POST['Email']));
$password = (htmlspecialchars($_POST['Password']));
$crypted_password = md5($password);
$target = "/";
$target_dns = "www";
$type = "CNAME";
$domain = "dev.fairsys.fr";
$user_domain = $username.".".$domain;
$server = "localhost";


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

// Instanciation de l'objet Host, DNS et Mail

$database = new DataBaseModel();
$host = new HostModel($userid);
$dns = new DnsModel($userid);
$mail = new MailModel($user_domain);

// Appel de la méthode

$database->setUsername($username);
$database->createDB($password, $server);

$host->setUsername($username);
$host->createUserVH($target);

$dns->setUsername($username);
$dns->createUserDns($type, $target_dns);

$mail->createdomain($username);

// Retour à la page principale

require_once __DIR__."/../view/new_account_done.php";

?>