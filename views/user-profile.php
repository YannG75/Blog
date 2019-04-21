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

        <?php require './controllers/nav.php'; ?>

        <section class="col-9">
            <header class="pb-3">
            </header>

            <form action="index.php?page=user-profile" method="post" class="p-4 row flex-column">

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