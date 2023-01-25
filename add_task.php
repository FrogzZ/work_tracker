<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
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
<?php include "blocks/header.php"?>

<div class="container">
    <form method="post" action="success.php">
        <div class="form-group">
            <label for="exampleFormControlInput1">Заголовок</label>
            <input type="text" class="form-control" name="title" required placeholder="Текст заголовка">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Описание задачи</label>
            <textarea class="form-control" name="description" required rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Срочность задачи</label>
            <select class="form-control" name="urgency">
                <option class="text-success" value="0">Нормально</option>
                <option class="text-warning" value="1">Побыстрее</option>
                <option class="text-danger" value="2">Срочно</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Добавить задачу</button>
    </form>
</div>
</body>
</html>