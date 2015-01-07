<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 25/08/2014
 * Time: 21:17
 */

// logout page

session_start();

unset($_SESSION['userid']);
header('Location: login.php');