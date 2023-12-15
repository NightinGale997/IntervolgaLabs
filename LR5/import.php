<?php
require_once 'database/db.php';
global $db;
if (isset($_POST["table_name"]) && isset($_POST["import_source"])) {
    // Получаем имя таблицы, в которую будем импортировать данные
    $table_name = $_POST["table_name"];

// Создаем имя таблицы с постфиксом _imported
    $imported_table_name = $table_name . "_imported";

// Определяем источник, откуда загружается файл
    $import_source = $_POST["import_source"];

// В зависимости от источника выполняем разные действия
    switch ($import_source) {
        case "user":
            // Файл, указанный пользователем с локального диска, загружается на сервер
            // Проверяем, что файл был загружен через форму
            if (isset($_FILES["file"])) {
                // Проверяем, что файл имеет формат XML
                if ($_FILES["file"]["type"] == "text/xml") {
                    // Читаем содержимое файла в строку
                    $file_content = file_get_contents($_FILES["file"]["tmp_name"]);
                } else {
                    // Некорректный тип файла
                    echo "Неверный тип файла. Пожалуйста, загрузите файл формата XML.";
                    exit;
                }
            } else {
                // Файл не был загружен
                echo "Пожалуйста, выберите файл для импорта.";
                exit;
            }
            break;
        case "server":
            // Файл берется с диска на сервере по указанному в поле пути
            // Получаем путь к файлу
            $file_path = $_POST["file_path"];
            // Проверяем, что файл существует и имеет формат XML
            if (file_exists($file_path) && mime_content_type($file_path) == "text/xml") {
                // Читаем содержимое файла в строку
                $file_content = file_get_contents($file_path);
            } else {
                // Некорректный путь или тип файла
                echo "Неверный путь или тип файла. Пожалуйста, укажите существующий файл формата XML.";
                exit;
            }
            break;
        case "link":
            // Файл берется с удаленного сервера по протоколу HTTP
            // Получаем ссылку на файл
            $file_url = $_POST["file_url"];
            // Используем cURL для получения файла
            $curl = curl_init($file_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $file_content = curl_exec($curl);
            curl_close($curl);
            // Проверяем, что файл имеет формат XML
            if (simplexml_load_string($file_content) !== false) {
                // Файл корректный
            } else {
                // Некорректный тип файла
                echo "Неверный тип файла. Пожалуйста, укажите ссылку на файл формата XML.";
                exit;
            }
            break;
        default:
            // Некорректный источник
            echo "Неверный источник. Пожалуйста, выберите один из следующих вариантов: user, server, link.";
            exit;
            break;
    }

// Создаем объект SimpleXMLElement из содержимого файла
    $xml = simplexml_load_string($file_content);

// Создаем новую таблицу в базе данных с теми же полями, что и в исходной таблице
// Получаем имена полей из первой записи в XML-файле
    $fields = array_keys((array)$xml->record[0]);
// Формируем SQL-запрос для создания таблицы
    $sql = "CREATE TABLE $imported_table_name (";
    foreach ($fields as $field) {
        $sql .= "$field VARCHAR(255), ";
    }
    $sql = rtrim($sql, ", ") . ")";
// Выполняем запрос
    $db->exec($sql);

// Добавляем данные в новую таблицу
// Формируем SQL-запрос для вставки данных
    $sql = "INSERT INTO $imported_table_name (";
    foreach ($fields as $field) {
        $sql .= "$field, ";
    }
    $sql = rtrim($sql, ", ") . ") VALUES (";
    foreach ($fields as $field) {
        $sql .= ":$field, ";
    }
    $sql = rtrim($sql, ", ") . ")";
// Подготавливаем запрос
    $stmt = $db->prepare($sql);
// Добавляем каждую запись из XML-файла в таблицу
    foreach ($xml->record as $record) {
        // Приводим запись к ассоциативному массиву
        $record = (array)$record;
        // Связываем параметры с значениями
        foreach ($record as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        // Выполняем запрос
        $stmt->execute();
    }

// Выводим сообщение об успешном импорте
    echo "Файл с данными получен из $import_source и обработан. Создана таблица $imported_table_name и " . $xml->count();
}

require_once 'layout/header.php';
?>
<form action="import.php" method="post" enctype="multipart/form-data">
    <p>Выберите имя таблицы, в которую вы хотите импортировать данные:</p>
    <select name="table_name">
        <option value="collectors">collectors</option>
        <option value="users">users</option>
        <option value="login_attempts">login_attempts</option>
    </select>
    <p>Выберите источник, откуда вы хотите загрузить файл:</p>
    <input type="radio" name="import_source" value="user" checked> Загруженный пользователем файл<br>
    <input type="file" name="file"><br>
    <input type="radio" name="import_source" value="server"> Файл с локального сервера<br>
    <input type="radio" name="import_source" value="link"> По внешней ссылке<br>
    <input type="submit" value="Импорт">
</form>


<?php require_once 'layout/footer.php'; ?>

