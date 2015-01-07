<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 22/08/2014
 * Time: 00:09
 */?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Authentification - Administration</title>

      <?php // CSS -- Bootstrap
      include_once(__DIR__ . "/css/header.php");
      ?>
      <!-- Custom styles for this template -->
      <link href="css/login.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" method="post" action="checkin.php">
        <h2 class="form-signin-heading">Authentification</h2>
        <input type="text" class="form-control" name="login" placeholder="Votre pseudonyme" required autofocus>
        <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="glyphicon glyphicon-link"></i> Connection</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>
