<?php
require "db/config.php";
$dbconn = pg_connect("host=$host dbname=$db user=$username password=$password")
or die('Не удалось соединиться: ' . pg_last_error());
try{
    $sql = "CREATE TABLE IF NOT EXISTS tasks (
        id serial PRIMARY KEY,
        title text,
        description text,
        archive boolean NOT NULL,
        create_at text NOT NULL,
        update_at text,
        urgency smallint NOT NULL
        )";
    $res = pg_query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS auth (
        id serial PRIMARY KEY,
        login varchar (100),
        pass varchar (32)
        )";
    $res = pg_query($sql);
    echo 'База создана успешно!';
} catch (Exception $e){
    echo 'Ошибка:' . $e;
} finally {
    pg_close($dbconn);
}
