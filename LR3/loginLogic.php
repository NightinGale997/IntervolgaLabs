<?php
require_once 'database/db.php'; // подключение к базе данных
function getValuesFromPost(): array {
    $defaultValues = [
        'email' => '',
        'password' => '',
    ];
    foreach ($_POST as $key => $value) {
        $defaultValues[$key] = htmlspecialchars($value);
    }
    return $defaultValues;
}
function enterInAccount($loginData) : array
{
    date_default_timezone_set('Europe/Volgograd');
    global $user;
    $errors = validate($loginData);
    if ($errors) {
        return $errors;
    }
    $_SESSION['user_id'] = $user['email'];
    header("Location: secretPage.php");
    exit();
}
function validate($loginData) : array {
    global $db;
    global $user;
    $errors = [];
    if (empty($loginData['email']) || empty($loginData['password'])) {
        $errors[] = "Не все поля заполнены";
        return $errors;
    }
    $stmt = $db->prepare("SELECT users.id, users.email, users.password FROM users WHERE email = :email");
    $stmt->execute(['email' => $loginData['email']]);
    $user = $stmt->fetch();
    if (!$user) {
        $errors[] = "Пользователь не найден";
    }
    elseif (strcmp(md5($loginData['password']), $user['password'])!= 0) {
        $errors[] = "Пароль неправильный";
    }
    return $errors;
}