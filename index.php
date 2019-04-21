<?php
require_once 'tools/common.php';

if(isset($_GET['page'])){

    switch ($_GET['page']) {
        case 'article':
            require('./controllers/article.php');
            break;
        case 'article_list':
            require('./controllers/article_list.php');
            break;
        case 'login-register':
            require('./controllers/login-register.php');
            break;
        case 'user-profile':
            require('./controllers/user-profile.php');
            break;
        default:
            require('./controllers/index.php');
            break;
    }

}
else{
    require('./controllers/index.php');

}



?>
