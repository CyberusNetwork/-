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

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable de session

$domain = (htmlspecialchars($_GET['deldns']));

// Instanciation de l'objet DNS

$dns = new DnsModel();

// Execution de la requête

$dns->init();
$dns->deleteDns($domain);

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

require_once __DIR__."/../view/delete_dns_done.php";

?>