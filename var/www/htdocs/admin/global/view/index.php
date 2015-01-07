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
    <title>Accueil - Administration</title>
    <!-- Bootstrap core CSS -->
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
    <meta charset="utf-8" />
</head>
<body>
<div class="container">
<div class="jumbotron">
  <h1>Bonjour <?php echo $username ?>, et bienvenue !</h1>
  <p>Vous êtes dans la partie administration de votre réseau.</p>
  <div class="btn-block">
      <ul class="list-inline">
          <li><p><a href="index.php?app=account"><button type="button" class="btn btn-success btn-lg btn-block">Compte</button></a></p><li>
          <li><p><a href="index.php?app=pf"><button type="button" class="btn btn-info btn-lg btn-block">PF</button></a></p><li>
          <li><p><a href="index.php?app=dns"><button type="button" class="btn btn-warning btn-lg btn-block">DNS</button></a></p><li>
          <li><p><a href="index.php?app=undef"><button type="button" class="btn btn-danger btn-lg btn-block">UNDEF</button></a></p></li>
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