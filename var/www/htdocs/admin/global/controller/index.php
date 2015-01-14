<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 27/08/2014
 * Time: 13:30
 */

//////////////////////////
// CONTROLLER index.php //
//////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once(__DIR__ . "/../../account/model/AccountModel.php");

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable de session

$userid = $_SESSION['userid'];

// Instanciation de l'objet ACCOUNT

$account = new AccountModel();

// Execution de la requête

$account->setSelectedDatas($userid);
$username = $account->getSelectedUsername();

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

require_once __DIR__."/../view/index.php";

?>