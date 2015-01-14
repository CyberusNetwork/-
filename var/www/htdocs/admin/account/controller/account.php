<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 27/08/2014
 * Time: 13:39
 */

////////////////////////////
// CONTROLLER account.php //
////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

include_once __DIR__."/../model/AccountModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

// Variable de session

$userid = $_SESSION['userid'];

// Instanciation de l'objet account

$account = new AccountModel();

// Execution de la requête --> Interrogation de la table USER par la classe AccountModel
// et sauvegarde les valeurs dans $datas_account

$account->init();

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

require_once __DIR__."/../view/account.php";
