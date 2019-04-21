<?php
require_once('./models/article.php');
isset($_GET['article_id']) AND ctype_digit($_GET['article_id']) ? $article = getArticle($_GET['article_id']) : '';
$article ? require_once('./views/article.php') : header('location:index.php');