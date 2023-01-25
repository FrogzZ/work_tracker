<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Готово</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<?php
require "db/config.php";
$dbconn = pg_connect("host=$host dbname=$db user=$username password=$password")
or die('Не удалось соединиться: ' . pg_last_error());

date_default_timezone_set('UTC');
$date = date('d.m.Y');

$query = "UPDATE tasks SET archive = true, update_at = '$date' where id = '$_POST[to_archive]'";
$res = pg_query($query);
if (!$res) {
    echo "Произошла ошибка\n";
    exit;
}else{?>
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Готово</h1>
            <p class="lead text-muted">Задача была добавлена в архив</p>
            <p>
                <a href="http://dev.tracker.ru/" class="btn btn-secondary my-2">К задачам</a>
            </p>
        </div>
    </section>

    </div>
<?php }?>
</body>
</html>

