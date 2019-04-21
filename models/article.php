<?php

//selection des 3 derniers articles PUBLIés ET dont la publish_date est inférieure ou égale à la date du jour

function getArticles( $page = false , $cat = false ){
    $db = dbConnect();
    if ($cat) {
        $queryString = 'SELECT a.* , c.name as category_name, c.id as category_id
        FROM article a JOIN article_category ac
        ON a.id = ac.article_id
        JOIN category c
        ON ac.category_id = c.id ';

    }

    else {
        $queryString = 'SELECT  a.* , GROUP_CONCAT( c.name ) as category_name
        FROM article a JOIN article_category ac
        ON a.id = ac.article_id
        JOIN category c
        ON ac.category_id = c.id ';
    }

    $queryParameters = [];

    if ($cat) {
        $queryString .= ' WHERE ac.category_id = ? AND a.published_at <= NOW() AND a.is_published = 1 ORDER BY a.published_at DESC';
        $queryParameters[] = $cat;
    }
    else {
        $queryString .= ' WHERE a.published_at <= NOW() AND a.is_published = 1 GROUP BY a.id DESC ';
    }
    if (!$page){
        $queryString .= ' LIMIT 3';
    }

$homeArticles = $db->prepare($queryString);
$homeArticles->execute($queryParameters);
  return $homeArticles->fetchAll();
}

function getArticle($articleId){
    $db = dbConnect();
    $query = $db->prepare('SELECT a.* , GROUP_CONCAT( c.name ) as category_name
		FROM article a JOIN article_category ac
        ON a.id = ac.article_id
        JOIN category c
        ON ac.category_id = c.id
		WHERE published_at <= NOW() AND is_published = 1 AND a.id = ? GROUP BY a.id');

    $query->execute(array($articleId));
    return $article = $query->fetch();
}