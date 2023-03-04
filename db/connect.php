<?php
require "db/config.php";
$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
    die("Ошибка: не удается подключиться: " . $conn->connect_error);
}

//$dbconn = pg_connect("host=$host dbname=$db user=$username password=$password")
//or die('Не удалось соединиться: ' . pg_last_error());
