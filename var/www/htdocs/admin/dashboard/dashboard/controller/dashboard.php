<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 30/12/2014
 * Time: 17:05
 */

//////////////////////////////
// CONTROLLER dashboard.php //
//////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// Appel aux classes de Model pour r�cup�rer les donn�es

include_once __DIR__."/../model/dashboardModel.php";

/////////////////////////////////////////////////////////////////////////////////////////
// Traitement des donn�es et des informations diverses

// Variable de session

$userid = $_SESSION['userid'];

// Instanciation de l'objet dashboard

$dashboard = new DashboardModel();

// R�cup�ration des information de la machine
$sysname = $dashboard->getSysName();
$sysdescrip = $dashboard->getSysDesc();
$sysuptime = $dashboard->getSysUpTime();
$systime = $dashboard->getSysTime();

// G�n�ration des graphiques de RRDTOOLS
$dashboard->setRrdGraph('cpu');
$dashboard->setRrdGraph('ram');
$dashboard->setRrdGraph('hdd');
$dashboard->setRrdGraph('sis0');
$dashboard->setRrdGraph('sis1');
$dashboard->setRrdGraph('sis2');
$dashboard->setRrdGraph('sis3');
$dashboard->setRrdGraph('sis4');

// R�cip�ration des adresses MAC des interfaces
$infoifmacsis0 = $dashboard->getInfoIfMac('sis0');
$infoifmacsis1 = $dashboard->getInfoIfMac('sis1');
$infoifmacsis2 = $dashboard->getInfoIfMac('sis2');
$infoifmacsis3 = $dashboard->getInfoIfMac('sis3');
$infoifmacsis4 = $dashboard->getInfoIfMac('sis4');

// R�cup�ration des IP des interfaces
$infoifipsis0 = $dashboard->getInfoIP('sis0');
$infoifipsis1 = $dashboard->getInfoIP('sis1');
$infoifipsis2 = $dashboard->getInfoIP('sis2');
$infoifipsis3 = $dashboard->getInfoIP('sis3');
$infoifipsis4 = $dashboard->getInfoIP('sis4');

/////////////////////////////////////////////////////////////////////////////////////////
// Rendu de la vue d'affichage

require_once __DIR__."/../view/dashboard.php";