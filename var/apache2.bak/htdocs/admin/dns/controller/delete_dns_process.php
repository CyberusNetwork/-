<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 25/08/2014
 * Time: 13:37
 */

///////////////////////////////////////
// CONTROLLER delete_dns_process.php //
///////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/DnsModel.php";
include_once __DIR__."/../../account/model/AccountModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable de session

$userid = $_SESSION['userid'];
$subdomain = (htmlspecialchars($_GET['deldns']));
$type = (htmlspecialchars($_GET['type']));
$target = (htmlspecialchars($_GET['target']));

// Instanciation de l'objet DNS

$dns = new DnsModel($userid);
$account = new AccountModel($userid);

// Execution de la requête

$account->init();
$username = $account->getUsername();

$dns->init();
$dns->setUsername($username);
$dns->deleteUserSubDomainDns($subdomain, $type, $target);

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

require_once __DIR__."/../view/new_dns_done.php";

?>