<?php
include "session/sessionStart.php";
include "database/db.php";
global $db;
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$sql = "SELECT * FROM collectors WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $_GET['img']]);
$row = $stmt->fetch();
if (!$row) {
    header("Location: login.php");
    exit();
}
$photo = "catalogue/img/" . $row['img_path'];
header('Content-Type: image/jpg');
readfile($photo);