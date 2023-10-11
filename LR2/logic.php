<?php
require_once 'db.php'; // подключение к базе данных
function getCollectorsFromDb(): array {
    global $db;
    $sql =
        'SELECT collectors.name as name,
        teams.name as team,
        collectors.birth_date,
        collectors.img_path,
        collectors.personal_description FROM collectors
        INNER JOIN teams ON collectors.id_team = teams.id WHERE 1=1 ';
    $arBinds = [];
    if (count($_GET) > 0) {
        if(!empty($_GET['id_team']) && intval($_GET['id_team'])) {
            $sql .= " AND collectors.id_team = :id_team";
            $arBinds['id_team'] = $_GET['id_team'];
        }
        if(!empty($_GET['name'])) {
            $sql .= " AND collectors.name LIKE :name";
            $arBinds['name'] = '%' . $_GET['name'] . '%';
        }
        if(!empty($_GET['birth_date']) && intval($_GET['birth_date'])) {
            $sql .= " AND birth_date = :birth_date";
            $arBinds['birth_date'] = $_GET['birth_date'];
        }
        if(!empty($_GET['personal_description'])) {
            $sql .= " AND personal_description LIKE :personal_description";
            $arBinds['personal_description'] = '%' . $_GET['personal_description'] . '%';
        }
    }
    $sql .= ' ORDER BY collectors.id';
    $stmt = $db->prepare($sql);
    $stmt->execute($arBinds);
    return $stmt->fetchAll();
}
function getTeamsFromDb(): array {
    global $db;
    $sql = 'SELECT * FROM teams';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $teams = $stmt->fetchAll();
    return $teams;
}
function getValuesFromGET(): array {
    $defaultValues = [
        'birth_date' => '',
        'name' => '',
        'personal_description' => ''
    ];
    foreach ($_GET as $key => $value) {
        $defaultValues[$key] = htmlspecialchars($value);
    }
    return $defaultValues;
}