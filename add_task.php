<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
?>
<?php include "blocks/head.php"?>
<body>
<?php
if($_COOKIE['user'] != ''):
?>
<?php include "blocks/header.php"?>
<div class="container">
    <form method="post" action="success.php" enctype="multipart/form-data">
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
        <div class="form-group">
            <label for="exampleFormControlFile1">Загрузить картинку</label>
            <input type="file" class="form-control-file" name="image">
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Добавить задачу</button>
    </form>
</div>
<?php endif;?>
</body>
</html>