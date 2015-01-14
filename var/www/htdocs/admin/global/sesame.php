<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 25/08/2014
 * Time: 21:12
 */

// Page de vérification de la présence d'un Session ID

session_start();

if (!isset ($_SESSION['userid']))
{
    header('Location: login.php');
}