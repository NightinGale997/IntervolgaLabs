<?php
require_once 'db.php'; // подключение к базе данных
function formatSqlQuery(&$query): void {
    if (str_ends_with($query, "AND")) {
        $query = substr($query, 0, -3);
    }
    if (str_ends_with($query, "WHERE ")) {
        $query = substr($query, 0, -6);
    }
    $query .= ' ORDER BY collectors.id';
}
function getCollectorsFromDb(): array {
    global $db;
    $sql =
        'SELECT collectors.name as name,
        teams.name as team,
        collectors.birth_date,
        collectors.img_path,
        collectors.personal_description FROM collectors
        INNER JOIN teams ON collectors.id_team = teams.id';
    $arBinds = [];
    if (count($_GET) > 0) {
        $sql .= " WHERE ";
        if(!empty($_GET['id_team'])) {
            $sql .= " collectors.id_team = :id_team AND";
            $arBinds['id_team'] = htmlspecialchars($_GET['id_team']);
        }
        if(!empty($_GET['name'])) {
            $sql .= " collectors.name LIKE :name AND";
            $arBinds['name'] = '%' . htmlspecialchars($_GET['name']) . '%';
        }
        if(!empty($_GET['birth_date'])) {
            $sql .= " birth_date = :birth_date AND";
            $arBinds['birth_date'] = htmlspecialchars($_GET['birth_date']);
        }
        if(!empty($_GET['personal_description'])) {
            $sql .= " personal_description LIKE :personal_description AND";
            $arBinds['personal_description'] = '%' . htmlspecialchars($_GET['personal_description']) . '%';
        }
    }
    formatSqlQuery($sql);
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
    if (!empty($_GET['id_team'])) {
        $teams[$_GET['id_team']-1]['selected'] = true;
    }
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