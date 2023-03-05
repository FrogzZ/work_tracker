<?php include "blocks/head.php"?>
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>
<body>
<?php
require "db/config.php";
require "db/connect.php";
date_default_timezone_set('UTC');
if ($_FILES['image']['name'] != ''){
    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $errorCode = $_FILES['image']['error'];
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpName)) {
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
            ];
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
            die($outputMessage);
        }
    };
    // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);
    // Получим MIME-тип
        $mime = (string) finfo_file($fi, $fileTmpName);
    // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
        if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
    // Результат функции запишем в переменную
        $image = getimagesize($fileTmpName);

    // Результат функции запишем в переменную
        $image = getimagesize($fileTmpName);

    // Зададим ограничения для картинок
        $limitBytes  = 1024 * 1024 * 3;
        $limitWidth  = 3000;
        $limitHeight = 3000;

    // Проверим нужные параметры
        if (filesize($fileTmpName) > $limitBytes) die('Размер изображения не должен превышать 3 Мбайт.');
        if ($image[1] > $limitHeight)             die('Высота изображения не должна превышать 3000 точек.');
        if ($image[0] > $limitWidth)              die('Ширина изображения не должна превышать 3000 точек.');

    // Сгенерируем новое имя файла на основе MD5-хеша
        $name = md5_file($fileTmpName);

    // Сгенерируем расширение файла на основе типа картинки
        $extension = image_type_to_extension($image[2]);

    // Сократим .jpeg до .jpg
        $format = str_replace('jpeg', 'jpg', $extension);
        $img = $name . $format;
    // Переместим картинку с новым именем и расширением в папку /upload
        if (!move_uploaded_file($fileTmpName, __DIR__ . '/img/upload/' . $name . $format)) {
            die('При записи изображения на диск произошла ошибка.');
        }
    }else{
    $img = null;
}

$date = date('d.m.Y');
$query = "INSERT INTO tasks VALUES (DEFAULT, '$_POST[title]','$_POST[description]', '0', '$date', '', '$_POST[urgency]', '$_COOKIE[user]', '$img')";
$conn->query($query);
$conn->close();
if (!$query) {
    echo "Произошла ошибка\n";
    exit;
}
//$dbconn = pg_connect("host=$host dbname=$db user=$username password=$password")
//or die('Не удалось соединиться: ' . pg_last_error());
//date_default_timezone_set('UTC');
//$date = date('d.m.Y');
//$query = "INSERT INTO tasks VALUES (DEFAULT, '$_POST[title]','$_POST[description]', '0', '$date', '', '$_POST[urgency]')";
//$res = pg_query($query);
//if (!$res) {
//    echo "Произошла ошибка\n";
//    exit;
//}
else{?>
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Готово</h1>
            <p class="lead text-muted">Задача была добавлена</p>
            <p>
                <a href="/" class="btn btn-secondary my-2">К задачам</a>
            </p>
        </div>
    </section>

</div>
<?php }?>
</body>
</html>

