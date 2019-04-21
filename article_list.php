<?php

require_once 'tools/common.php';

//si une catégorie est demandée
if (isset($_GET['category_id'])) {
    //si l'id envoyé n'est pas un nombre entier, je redirige
    if (!ctype_digit($_GET['category_id'])) {
        header('location:index.php');
        exit;
    }
    //selection des articles de la catégorie demandée
    $queryArticles = $db->prepare('SELECT a.* , c.name as category_name, c.id as category_id
		FROM article a JOIN article_category ac
        ON a.id = ac.article_id
        JOIN category c
        ON ac.category_id = c.id
		WHERE ac.category_id = ? AND a.published_at <= NOW() AND a.is_published = 1
		ORDER BY a.published_at DESC');

    $queryArticles->execute(array($_GET['category_id']));

    //selection des informations de la catégorie demandée


    //si la catégorie n'a pas été trouvé je redirige
    if ($selectedCategory == false) {
        header('location:index.php');
        exit;
    }
} else {
    //si pas decatégorie demandée j'affiche tous les articles
    $queryArticles = $db->query('SELECT  a.* , GROUP_CONCAT( c.name ) as category_name
	FROM article a JOIN article_category ac
	ON a.id = ac.article_id
	JOIN category c
	ON  ac.category_id  = c.id
	WHERE a.published_at <= NOW() AND a.is_published = 1 GROUP BY id
	ORDER BY a.published_at DESC');
}
//puis je récupère les données selon la requête générée avant
$articles = $queryArticles->fetchAll();


?>


