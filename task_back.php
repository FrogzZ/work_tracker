<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>
<?php include "blocks/head.php"?>
<body>
<?php
require "db/config.php";
require "db/connect.php";
$query = "UPDATE tasks SET archive = 0 where id = '$_POST[task_back]'";
$conn->query($query);
$conn->close();
if (!$query) {
    echo "Произошла ошибка\n";
    exit;
}
else{?>
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Готово</h1>
            <p class="lead text-muted">Задача была добавлена в работу</p>
            <p>
                <a href="/" class="btn btn-secondary my-2">К задачам</a>
            </p>
        </div>
    </section>

    </div>
<?php }?>
</body>
</html>

