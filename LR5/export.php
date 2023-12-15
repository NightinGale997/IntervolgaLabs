<?php
// Подключаемся к базе данных
require_once 'database/db.php';
global $db;

if (isset($_POST['table_name']) && isset($_POST['export_type'])) {
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
    $export_type = $_POST["export_type"];
    switch ($export_type) {
        case "download":
            header("Content-Type: text/xml");
            header("Content-Disposition: attachment; filename=$file_name");
            echo $xml->asXML();
            break;
        case "save":
            $file_path = "/files/$file_name";
            $xml->saveXML($file_path);
            echo "Файл с данными сохранен на диск по адресу: $file_path";
            break;
        case "post":
            $worker_url = "http://example.com/worker.php";
            $curl = curl_init($worker_url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array("file" => $xml->asXML()));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
            echo "$file_name передан скрипту worker.php по протоколу HTTP методом POST. Ссылка для скачивания $response";
            break;
        default:
            echo "Неверный тип экспорта. Пожалуйста, выберите один из следующих вариантов: download, save, post.";
            break;
    }
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
    <p>Выберите тип экспорта:</p>
    <input type="radio" name="export_type" value="download" checked> Файл на скачивание<br>
    <input type="radio" name="export_type" value="save"> Файл на диск<br>
    <input type="radio" name="export_type" value="post"> Файл по HTTP POST<br>
    <input type="submit" value="Экспорт">
</form>
<?php require_once 'layout/footer.php'; ?>
