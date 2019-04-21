<?php
require_once('./models/login-register.php');
if(isset($_POST['login'])) login();
if(isset($_POST['register'])) register();
if(isset($_SESSION['user'])){
    header('location:index.php');
    exit;
}
require_once('./views/login-register.php');
