<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Work Tracker</title>
</head>
<body>
<?php
if($_COOKIE['user'] == ''):
?>
<div class="container mt-5">
    <form method="post" action="check.php">
        <div class="form-group">
            <label for="username">Логин:</label>
            <input type="text" name="username" class="form-control" required placeholder="Логин">
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" name="password" class="form-control" required placeholder="Пароль">
        </div>
        <input type="submit" class="btn btn-success d-block mx-auto" value="Войти">
    </form>
</div>
<?php else:?>

<?php include "blocks/header.php"?>
<?php
require "db/config.php";
$dbconn = pg_connect("host=$host dbname=$db user=$username password=$password")
or die('Не удалось соединиться: ' . pg_last_error());

$res = pg_query($dbconn, "SELECT * FROM tracker.public.tasks where archive = false ORDER BY id DESC");
if (!$res) {
    echo "Произошла ошибка\n";
    exit;
}
$get_all_tasks = pg_fetch_all($res);
pg_close($dbconn);
?>

<?php foreach ($get_all_tasks as $active):?>
    <div class="container mt-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-header <?php
            switch ($active['urgency']) {
                case 0:
                    echo 'bg-success';
                    break;
                case 1:
                    echo 'bg-warning';
                    break;
                case 2:
                    echo 'bg-danger';
                    break;
            }
            ?>">
                <h4 class="my-0 font-weight-normal text-white"><?php echo $active["title"];?></h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mt-3 mb-4">
                    <li><?php echo $active["description"];?></li>
                    <small id="emailHelp" class="form-text text-muted">Задание добавлено: <?php echo $active["create_at"];?></small>
                </ul>
                <form method="post" action="task_to_archive.php">
                    <button type="submit" name="to_archive" value="<?php echo $active["id"];?>" class="btn btn-lg btn-block btn-outline-success">Задача готова</button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php endif;?>
</body>
</html>