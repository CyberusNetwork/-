<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 25/08/2014
 * Time: 21:17
 */

// Page de déconnection

session_start();

unset($_SESSION['userid']);
header('Location: login.php');