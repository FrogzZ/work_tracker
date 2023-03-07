<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
?>
<?php include "blocks/head.php"?>
<?php
if($_COOKIE['user'] != ''):
?>
<?php include "blocks/header.php"?>
<?php
    require "db/config.php";
    require "db/connect.php";
    $sql = "SELECT * FROM tasks where archive = true ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $get_all_tasks = mysqli_fetch_all($result);
    $conn->close();

//$dbconn = pg_connect("host=$host dbname=$db user=$username password=$password")
//or die('Не удалось соединиться: ' . pg_last_error());
//$res = pg_query($dbconn, "SELECT * FROM tracker.public.tasks where archive = true ORDER BY id DESC");
//if (!$res) {
//    echo "Произошла ошибка\n";
//    exit;
//}
//$get_all_tasks = pg_fetch_all($res);
//pg_close($dbconn);
?>

    <?php foreach ($get_all_tasks as $active):?>
    <div class="container mt-2">
        <div class="card mb-2 shadow-sm">
            <div class="card-header <?php
            switch ($active[6]) {
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
                <h4 class="my-0 font-weight-normal text-white"><?php echo $active[1];?></h4>
            </div>

            <div class="media">
                <?php $img = 'noimg.png';
                if ($active[8] != Null){
                    $img = '/upload/'.$active[8];
                }
                ?>
                <a href="img/<?=$img;?>" target="_blank"><img class="m-3 rounded" src="img/<?php echo $img;?>" width="150" height="150" alt="Task image"></a>
                <div class="media-body">
                    <ul class="list-unstyled mt-3 mb-4 m-3">
                        <li><?php echo $active[2];?></li>
                        <small id="emailHelp" class="form-text text-muted">Задание завершено: <?php echo $active[5];?></small>
                    </ul>
                    <form method="post" action="task_back.php" class="m-3">
                        <button type="submit" name="task_back" value="<?php echo $active[0];?>" class="btn btn-lg btn-block btn-outline-danger">Вернуть задачу</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php endif; ?>
</body>
</html>