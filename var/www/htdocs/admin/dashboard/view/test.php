<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 12/01/2015
 * Time: 15:58
 */

include_once __DIR__."/../model/dashboardModel.php";

$dashboard = new DashboardModel();

$infoifsis0 = $dashboard->getInfoIf('sis0');

var_dump($infoifsis0);