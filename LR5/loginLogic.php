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
    $errors = [
    ];
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
    $currentDate = new DateTime('now');
    $currentDate->sub(DateInterval::createFromDateString('1 hour'));
    $strDate = $currentDate->format('Y-m-d H:i:s');
    $stmt = $db->prepare("SELECT user_id, succesful, date FROM login_attempts WHERE date > :date AND succesful = FALSE");
    $stmt->execute(['date' => $strDate]);
    $attempts = $stmt->fetchAll();
    if (count($attempts) > 2) {
        $errors[0] = "Учётная запись заблокирована";
        $stmt = $db->prepare("INSERT INTO login_attempts (user_id, succesful, date) VALUES({$user['id']}, FALSE, :date)");
        $stmt->execute(['date' => $strDate]);
    }
    if ($errors) {
        $stmt = $db->prepare("INSERT INTO login_attempts (user_id, succesful, date) VALUES({$user['id']}, FALSE, :date)");
    }
    else {
        $stmt = $db->prepare("INSERT INTO login_attempts (user_id, succesful, date) VALUES({$user['id']}, TRUE, :date)");
    }
    $currentDate = new DateTime('now');
    $strDate = $currentDate->format('Y-m-d H:i:s');
    $stmt->execute(['date' => $strDate]);

    return $errors;
}