<!DOCTYPE html>
<html>
<head>
    <title><?= $article['title']; ?> - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>
</head>
<body class="article-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>
    <div class="row my-3 article-content">
        <?php require './controllers/nav.php'; ?>
        <main class="col-9">
            <article>
                <img class="pb-4 img-fluid" src="img/article/<?= $article['image'] ?>" alt="">
                <h1><?= $article['title']; ?></h1>
                <strong class="article-category">[<?= $article['category_name']; ?>]</strong>
                <span class="article-date">
						<!-- affichage de la date de l'article selon le format %A %e %B %Y -->
                    <?= strftime("%A %e %B %Y", strtotime($article['published_at'])); ?>
					</span>
                <div class="article-content">
                    <?= $article['content']; ?>
                </div>
            </article>
        </main>
    </div>
    <?php require 'partials/footer.php'; ?>
</div>
</body>
</html>

