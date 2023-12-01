<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=seven_semen', 'root');
}
catch (PDOException $e) {
    echo $e->getMessage();
    die;
}
