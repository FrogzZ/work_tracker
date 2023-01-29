<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$login = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

if(mb_strlen($login) < 5 || mb_strlen($login) > 90){
    echo "Недопустимая длина логина";
    exit;
}

if(mb_strlen($pass) < 2 || mb_strlen($pass) > 10){
    echo "Недопустимая длина пароля";
    exit;
}

$pass = md5($pass . "jdpqdle");
require "db/config.php";
$dbconn = pg_connect("host=$host dbname=$db user=$username password=$password")
or die('Не удалось соединиться: ' . pg_last_error());

$res = pg_query($dbconn, "SELECT * FROM auth WHERE login = '$login' AND pass = '$pass'");

$get_user = pg_fetch_assoc($res);
pg_close($dbconn);

if($get_user === false){
    echo "Пользователь не найден";
    exit();
}

setcookie('user', $get_user['login'], time() + 3600 * 24 * 30, "/");

header('Location: /');