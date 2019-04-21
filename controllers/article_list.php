<?php
require_once('./models/article.php');
$page = true;
if(isset($_GET['category_id'])) { $articles = getArticles($page , $cat = $_GET['category_id']); }
else { $articles = getArticles($page); }
require_once('./models/category.php');
if(isset($_GET['category_id'])) $selectedCategory = getcategory();
$articles ? require('./views/article_list.php') : header('location:index.php');
