<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 25/08/2014
 * Time: 13:36
 */?>

<!DOCTYPE html>
<html lang="fr">
<head>
        <title>Accueil - Administration - dev.fairsys.fr</title>
        <!-- Bootstrap core CSS -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <meta charset="utf-8" />
</head>
<body>
<div class="container">
<div class="jumbotron">
  <h1>Bonjour <?php echo $username ?>, et bienvenue !</h1>
  <p>Vous êtes dans la partie administration de votre solution d'hébergement.</p>
  <div class="btn-block">
      <ul class="list-inline">
          <li><p><a href="index.php?app=account"><button type="button" class="btn btn-success btn-lg btn-block">Compte</button></a></p><li>
          <li><p><a href="index.php?app=mail"><button type="button" class="btn btn-info btn-lg btn-block">Mails</button></a></p><li>
          <li><p><a href="index.php?app=dns"><button type="button" class="btn btn-warning btn-lg btn-block">DNS</button></a></p><li>
          <li><p><a href="index.php?app=site"><button type="button" class="btn btn-danger btn-lg btn-block">Site</button></a></p></li>
      </ul>
  </div>
</div>

<!-- footer -->
    <?php
    include __DIR__."/../../global/view/footer.php"
    ?>
</div>
</body>

</html>