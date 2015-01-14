<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Votre compte utilisateur - Administration</title>
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
    <script src="./../css/script_pwd.js"></script>
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

    <form role="form" id="changeAccountForm" action="index.php?page=edit_account_confirmed" method="post">

        <?php foreach($account->getSelectedDatas() as $line){ ?>

        <div class="form-group">
            <label for="username">Pseudonyme</label>
            <input type="text" class="form-control" id="field_username" name="Username" value="<?php echo $line["username"]; ?>" readonly>
            <p class="help-block">Nota Bene : Ce pseudonyme est votre identifiant sur ce serveur. Il n'est pas modifiable !</p>
        </div>
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input type="text" class="form-control" name="Lastname" value="<?php echo $line["lastname"]; ?>" required pattern="\w+">
        </div>
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" name="Firstname" value="<?php echo $line["firstname"]; ?>" required pattern="\w+">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="Email" value="<?php echo $line["mail"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="Password" placeholder="New Password" required>
            <span id="result"></span>
            <p class="help-block">Le mot de passe doit comporter au moins 8 caractères, incluant des MAJUSCULES, des minuscules et des chiffres, incluant un caractère spécial : !,%,&,@,#,$,^,*,?,_,~," </p>
        </div>
        <div class="form-group">
            <label for="password">Confirm Password</label>
            <input type="password" class="form-control" id="passwordCheck" name="ConfirmPassword" placeholder="Confirm New Password" required>
        </div>

        <a href="./../index.php?app=account"><button class="btn btn-default"  type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>
        <?php } ?>
    </form>

</div>
</body>
</html>

