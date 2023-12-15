<?php
require_once 'database/db.php';
global $db;

if (isset($_POST['table_name'])) {
    $table_name = $_POST["table_name"];
    $file_name = $table_name . "_exported.xml";
    $xml = new SimpleXMLElement("<$table_name></$table_name>");
    $query = $db->query("SELECT * FROM $table_name");
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $record = $xml->addChild("record");
        foreach ($row as $key => $value) {
            $record->addChild($key, $value);
        }
    }
    $file_path = "/files/$file_name";
    $xml->saveXML($file_path);
    echo "Файл с данными сохранен на диск по адресу: $file_path";
    exit();
}
require_once 'layout/header.php';
?>
<form action="export.php" method="post">
    <p>Выберите имя таблицы, из которой вы хотите экспортировать данные:</p>
    <select name="table_name">
        <option value="collectors">collectors</option>
        <option value="users">users</option>
        <option value="login_attempts">login_attempts</option>
    </select>
    <p>Файл на скачивание</p>
    <input type="submit" value="Экспорт">
</form>
<?php require_once 'layout/footer.php'; ?>
