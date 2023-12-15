<?php
require_once 'database/db.php';
global $db;
if (isset($_POST["table_name"])) {
    $table_name = $_POST["table_name"];
    $imported_table_name = $table_name . "_imported";

if (isset($_FILES["file"])) {
    if ($_FILES["file"]["type"] == "text/xml") {
        $file_content = file_get_contents($_FILES["file"]["tmp_name"]);
    } else {
        echo "Неверный тип файла. Пожалуйста, загрузите файл формата XML.";
        exit;
    }
} else {
    echo "Пожалуйста, выберите файл для импорта.";
    exit;
}

    $xml = simplexml_load_string($file_content);

    $fields = array_keys((array)$xml->record[0]);
    $sql = "CREATE TABLE $imported_table_name (";
    foreach ($fields as $field) {
        $sql .= "$field VARCHAR(255), ";
    }
    $sql = rtrim($sql, ", ") . ")";
    $db->exec($sql);

    $sql = "INSERT INTO $imported_table_name (";
    foreach ($fields as $field) {
        $sql .= "$field, ";
    }
    $sql = rtrim($sql, ", ") . ") VALUES (";
    foreach ($fields as $field) {
        $sql .= ":$field, ";
    }
    $sql = rtrim($sql, ", ") . ")";
    $stmt = $db->prepare($sql);
    foreach ($xml->record as $record) {
        $record = (array)$record;
        foreach ($record as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
    }

    echo "Файл с данными получен и обработан. Создана таблица $imported_table_name и " . $xml->count() . " записей импортировано.";
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
    <p>Выберите файл:</p>
    <input type="file" name="file"><br>
    <input type="submit" value="Импорт">
</form>


<?php require_once 'layout/footer.php'; ?>

