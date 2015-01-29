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


// Instanciation de l'objet Account, Host, DNS et Mail

$account = new AccountModel();
$account->init();

$userid = $_GET['UserID'];
$account->setSelectedDatas($userid);
$username = $account->getSelectedUsername();

// Appel de la méthode

$account->deleteUser($userid, $username);

// Retour à la page principale

require_once __DIR__."/../view/delete_account_done.php";
