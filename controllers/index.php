<?php
require_once('./models/article.php');
$homeArticles = getArticles();
require('./views/index.php');