<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 28/08/2014
 * Time: 00:12
 */

/////////////////////////////////////////////
// CONTROLLER - delete_account_process.php //
/////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour récupérer les données

(include_once __DIR__."/../model/AccountModel.php");

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

$userid = $_SESSION['userid'];

// Instanciation de l'objet Account, Host, DNS et Mail

$account = new AccountModel($userid);
$account->init();

$username = $account->getUsername();

// Appel de la méthode

$account->deleteUser();

// Retour à la page principale

require_once __DIR__."/../view/delete_account_done.php";
