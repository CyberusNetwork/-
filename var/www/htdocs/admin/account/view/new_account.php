<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Création de votre compte utilisateur - Administration</title>
    <!-- Bootstrap core CSS -->
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
    <script src="./../js/script_pwd.js"></script>
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Création de votre compte utilisateur <small><i>Désolé, mais il nous manque une case !</i></small></h1>
    </div>

    <!-- Contents -->
    <p class="lead">Il va falloir remplir les blancs...</p>
    <p>Voici votre petite "fiche" à remplir. Crayons et gommes sont autorisés par contre pas la calculatrice, nous avez 1 heure.</p>

    <!-- USER info form -->

    <form class="form-horizontal" id="AccountForm" action="./index.php?page=new_account_confirmed" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username" >Pseudonyme</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Username" placeholder="EVA-01 (max : 20 caractères)" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$">
                <p class="help-block">Nota Bene : Ce pseudonyme sera votre nom sur ce serveur alors, choisissez-le bien, il n'est pas modifiable !</p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="lastname">Nom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Lastname" placeholder="Ikari" required pattern="\w+">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="firstname">Prénom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Firstname" placeholder="Shinji" required pattern="\w+">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="email">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="Email" placeholder="shinji.ikari@jp.nerv.org" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="password">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="Password" placeholder="Password" required>
                <p class="help-block">Le mot de passe doit comporter au moins 8 caractères, incluant des MAJUSCULES, des minuscules et des chiffres, incluant un caractère spécial : !,%,&,@,#,$,^,*,?,_,~," </p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"  for="password">Confirm Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="passwordCheck" name="ConfirmPassword" placeholder="Confirm Password" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="button"></label>
            <div class="col-sm-10">
                <span id="result"></span>
                <button class="btn btn-success" type="submit" disabled id="validate_button"><i class="glyphicon glyphicon-check"></i> Valider</button>
                <a href="../index.php?app=account"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>
            </div>
        </div>
    </form>
</div>
</body>
</html>