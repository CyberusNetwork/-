<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 28/08/2014
 * Time: 00:07
 */

////////////////////////////////////
// CONTROLLER new_dns_process.php //
////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/DnsModel.php";
include_once __DIR__."/../../account/model/AccountModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable de session

$userid = $_SESSION['userid'];
$subdomain = (htmlspecialchars($_POST['NewDns']));
$type = (htmlspecialchars($_POST['Type']));
$target = (htmlspecialchars($_POST['Target']));


// Instanciation de l'objet DNS

$dns = new DnsModel($userid);
$account = new AccountModel($userid);

// Execution de la requête

$account->init();
$username = $account->getUsername();
$dns->init();
$dns->setUsername($username);
$dns->createUserSubDomainDns($subdomain, $type, $target);

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

require_once __DIR__."/../view/new_dns_done.php";
