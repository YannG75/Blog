<?php
function profileUpdt(){
        $db = dbConnect();
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

        return array($success, isset($message)? $message : '');
}

function recupProfile() {
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM user WHERE id = ?');
    $query->execute(array($_SESSION['user']['id']));
//$user contiendra les informations de l'utilisateur dont l'id a été envoyé en paramètre d'URL
    return $userUpdt = $query->fetch();
}