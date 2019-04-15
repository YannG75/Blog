<?php
require_once 'tools/common.php';
if (isset($_GET['logout']) && isset($_SESSION['user'])) {
    unset($_SESSION["user"]);
}

if (!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 1) {
    header('location:index.php');
    exit;
}
if (isset($_SESSION['user']['message'])) {
    unset($_SESSION['user']['message']);
}
if (isset($_POST['profileUpdt'])) {

//début de la chaîne de caractères de la requête de mise à jour
    $queryString = 'UPDATE user SET firstname = :firstname, lastname = :lastname, email = :email, bio = :bio ';
//début du tableau de paramètres de la requête de mise à jour
    $queryParameters = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'bio' => $_POST['bio'],
        'id' => $_SESSION['user']['id']
    ];

//uniquement si l'admin souhaite modifier le mot de passe
    if (!empty($_POST['password']) AND $_POST['password'] != $_POST['password_confirm']) {

        $message = 'Votre mot de passe n\'as pas été modifié ! Vérifiez que la confirmation est bien identique ! ';

        //concaténation du champ password à mettre à jour

    } elseif (!empty($_POST['password']) AND $_POST['password'] = $_POST['password_confirm']) {
        $queryString .= ', password = :password ';
        //ajout du paramètre password à mettre à jour
        $queryParameters['password'] = hash('md5', $_POST['password']);
    }
//fin de la chaîne de caractères de la requête de mise à jour
    $queryString .= 'WHERE id = :id';

//préparation et execution de la requête avec la chaîne de caractères et le tableau de données
    $query = $db->prepare($queryString);
    $resultUpdt = $query->execute($queryParameters);
    if ($resultUpdt) {
        $_SESSION['user']['firstname'] = $_POST['firstname'];
        $_SESSION['user']['lastname'] = $_POST['lastname'];
        $_SESSION['user']['email'] = $_POST['email'];
        $_SESSION['user']['bio'] = $_POST['bio'];
        $success = $_SESSION['user']['message'] = '<div class="alert alert-success" role="alert">Modifications réussies</div>';
    } else { //si pas $newUser => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
        $message = "Impossible de modifier l'utilisateur...";
    }
}
$query = $db->prepare('SELECT * FROM user WHERE id = ?');
$query->execute(array($_SESSION['user']['id']));
//$user contiendra les informations de l'utilisateur dont l'id a été envoyé en paramètre d'URL
$userUpdt = $query->fetch();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>
</head>
<body class="index-body">
<div class="container-fluid">

    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">

        <?php require 'partials/nav.php'; ?>

        <section class="col-9">
            <header class="pb-3">
            </header>

            <form action="user-profile.php" method="post" class="p-4 row flex-column">

                <h4 class="pb-4 col-sm-8 offset-sm-2">Mise à jour des informations utilisateur</h4>
                <?= isset($success) ? $success : ' '; ?>

                <div class="form-group col-sm-8 offset-sm-2">
                    <label for="firstname">Prénom </label>
                    <input class="form-control"
                           value="<?= isset($message) ? $_POST['firstname'] : $userUpdt['firstname'] ?>" type="text"
                           placeholder="Prénom" name="firstname" id="firstname"/>
                </div>
                <div class="form-group col-sm-8 offset-sm-2">
                    <label for="lastname">Nom de famille</label>
                    <input class="form-control"
                           value="<?= isset($message) ? $_POST['lastname'] : $userUpdt['lastname'] ?>" type="text"
                           placeholder="Nom de famille" name="lastname" id="lastname"/>
                </div>
                <div class="form-group col-sm-8 offset-sm-2">
                    <label for="email">Email </label>
                    <input class="form-control" value="<?= isset($message) ? $_POST['email'] : $userUpdt['email'] ?>"
                           type="email" placeholder="Email" name="email" id="email"/>
                </div>
                <div class="form-group col-sm-8 offset-sm-2">
                    <?php if (isset($message)):?>
                        <div class="bg-danger text-white">
                            <?= $message; ?>
                        </div>
                    <?php endif; ?>
                    <label for="password">Mot de passe </label>
                    <input class="form-control" value="" type="password" placeholder="Mot de passe" name="password"
                           id="password"/>
                </div>
                <div class="form-group col-sm-8 offset-sm-2">
                    <label for="password_confirm">Confirmation du mot de passe </label>
                    <input class="form-control" value="" type="password" placeholder="Confirmation du mot de passe"
                           name="password_confirm" id="password_confirm"/>
                </div>
                <div class="form-group col-sm-8 offset-sm-2">
                    <label for="bio">Biographie</label>
                    <textarea class="form-control" name="bio" id="bio"
                              placeholder="Ta vie Ton oeuvre..."><?= isset($message) ? $_POST['bio'] : $userUpdt['bio'] ?></textarea>
                </div>

                <div class="text-right col-sm-8 offset-sm-2">
                    <input class="btn btn-success" type="submit" name="profileUpdt" value="Valider"/>
                </div>

            </form>

        </section>
    </div>

    <?php require 'partials/footer.php'; ?>

</div>

</body>
</html>