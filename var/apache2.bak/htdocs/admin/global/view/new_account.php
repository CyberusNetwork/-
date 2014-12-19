<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Création de votre compte utilisateur - Administration - dev.fairsys.fr</title>
    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8" />
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

    <form class="form-horizontal" role="form" action="new_account.php?page=processing" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username">Pseudonyme</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Username" placeholder="mastermind">
                <p class="help-block">Nota Bene : Ce pseudonyme sera votre nom de domaine sur ce serveur alors, choisissez-le bien, il n'est pas modifiable ! - Ici : mastermind.dev.fairsys.fr</p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="lastname">Nom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Lastname" placeholder="Professeur Moriarty">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="firstname">Prénom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Firstname" placeholder="James">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="email">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="Email" placeholder="james.moriarty@youmissme.com">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="password">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="Password" placeholder="Password">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="button"></label>
            <div class="col-sm-10">
                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-plus"></i> S'inscrire</button>
                <a href="index.php"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-chevron-left"></i> Retour</button></a>
            </div>
        </div>

    </form>

</div>
</body>
</html>