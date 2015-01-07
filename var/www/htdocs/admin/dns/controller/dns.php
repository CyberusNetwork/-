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

// Instanciation de l'objet DNS et USER

$dns = new DnsModel();

// Execution de la requête

$dns->init();

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

require_once __DIR__."/../view/dns.php";

?>