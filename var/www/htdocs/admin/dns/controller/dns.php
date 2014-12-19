<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 27/08/2014
 * Time: 12:37
 */
////////////////////////
// CONTROLLER dns.php //
////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/DnsModel.php";
include_once __DIR__."/../../account/model/AccountModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable de session

$userid = $_SESSION['userid'];

// Instanciation de l'objet DNS et USER

$dns = new DnsModel($userid);
$account = new AccountModel($userid);

// Execution de la requête

$account->init();
$username = $account->getUsername();

$dns->init();
$dns->setUsername($username);
$domain = "dev.fairsys.fr";
$user_domain = $username.".".$domain;

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

require_once __DIR__."/../view/dns.php";

?>