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
(include_once __DIR__."/../../site/model/HostModel.php");
(include_once __DIR__."/../../dns/model/DnsModel.php");
(include_once __DIR__."/../../mail/model/MailModel.php");
(include_once __DIR__."/../../account/model/DataBaseModel.php");

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des données et des informations diverses

$userid = $_SESSION['userid'];
$domain = "dev.fairsys.fr";
$server = "localhost";

// Instanciation de l'objet Account, Host, DNS et Mail

$account = new AccountModel($userid);
$account->init();

$host = new HostModel($userid);
$host->init();

$dns = new DnsModel($userid);
$dns->init();

$database = new DataBaseModel();

$username = $account->getUsername();

$user_domain = $username.".".$domain;
$mail = new MailModel($user_domain);

// Appel de la méthode

// Mise en place des WHILE afin de vérifier et supprimer les sous-domaines,
// les boites mails et les entrées DNS avant la suppression definitive du compte

    // HOST

$host->setUsername($username);

foreach ($host->getDatas() as $host_data) {
    $subdomain = $host_data['dns'];
    $host->deleteSubDomainVHFinal($subdomain);
}
$host->deleteUserVH();


    // DNS

$dns->setUsername($username);

foreach ($dns->getDatas() as $dns_data) {
    $subdomain = $dns_data['sub_dom'];
    $type = $dns_data['type'];
    $target = $dns_data['target'];
    $dns->deleteUserSubDomainDnsFinal($subdomain, $type, $target);
}
$dns->deleteUser();

    // Mail

foreach ($mail->getDatas() as $mail_data) {
    $maildir = $mail_data['maildir'];
    $mail->deleteMail($maildir);
}
$mail->deleteDomain();

    // Database

$database->setUsername($username);
$database->deleteDB($server);

    // Account

$account->deleteUser();


// Retour à la page principale

require_once __DIR__."/../view/delete_account_done.php";
