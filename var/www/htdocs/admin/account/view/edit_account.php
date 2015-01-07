<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Votre compte utilisateur - Administration</title>
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Toutes les informations de votre compte <small><i>C'est mieux que les RG !</i></small></h1>
    </div>

    <!-- Contents -->
    <p class="lead">Gérer votre compte utilisateur.</p>
    <p>Voici votre "fiche" de renseignement. C'est presque aussi bien que Facebook, mais en un peu plus personnel :-)</p>

    <!-- USER info Table-->

    <form role="form" action="index.php?page=edit_account_confirmed" method="post">

        <div class="form-group">
            <label for="username">Pseudonyme</label>
            <input type="text" class="form-control" name="Username" value="<?php echo $account->getDatas()["username"]; ?>" readonly>
            <p class="help-block">Nota Bene : Ce pseudonyme est votre nom de domaine sur ce serveur. Il n'est pas modifiable !</p>
        </div>
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input type="text" class="form-control" name="Lastname" value="<?php echo $account->getDatas()["lastname"]; ?>">
        </div>
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" name="Firstname" value="<?php echo $account->getDatas()["firstname"]; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="Email" value="<?php echo $account->getDatas()["mail"]; ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="Password" placeholder="New Password">
        </div>
        <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-check"></i> Valider</button>
        <a href="/../index.php?app=account"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>
    </form>


</div>
</body>
</html>

