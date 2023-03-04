<?php
$get_user = $_COOKIE['user'];
//exit();
setcookie('user', $get_user, time() - 3600 * 24 * 30, "/");
header('/');