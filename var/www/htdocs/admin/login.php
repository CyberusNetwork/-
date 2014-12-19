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
    <title>Authentification - Administration - dev.fairsys.fr</title>

    <!-- Bootstrap core CSS -->
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
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
        <a href="new_account.php?page=new" <button class="btn btn-lg btn-success btn-block" type="button"><i class="glyphicon glyphicon-plus"></i> Nouveau Compte</button></a>
      </form>

    </div> <!-- /container -->
  </body>
</html>
