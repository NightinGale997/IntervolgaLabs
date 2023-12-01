<?php
require_once 'database/db.php'; // подключение к базе данных
function getValuesFromPost(): array {
    $defaultValues = [
        'email' => '',
        'password' => '',
        'interests' => '',
        'address' => '',
        'name' => '',
        'birth_date' => '',
        'sex' => '',
        'vk_profile' => '',
        'blood_type' => '',
        'rh_factor' => ''
    ];
    foreach ($_POST as $key => $value) {
        $defaultValues[$key] = htmlspecialchars($value);
    }
    return $defaultValues;
}

function addUserInDb($userData) {
    global $db;
    $errors = validate($userData);
    if (!empty($check[0]) || !empty($check[1]))
        return $errors;
    $passwordHashed = md5($userData['password']);
    $data = [
        'email' => $userData['email'],
        'name' => $userData['name'],
        'birth_date' => $userData['birth_date'],
        'address' => $userData['address'],
        'sex' => $userData['sex'],
        'interests' => $userData['interests'],
        'vk_profile' => $userData['vk_profile'],
        'blood_type' => $userData['blood_type'],
        'rh_factor' => $userData['rh_factor'],
        'password' => $passwordHashed,
    ];
    $sql = "INSERT INTO users (email, name, birth_date, address, sex, interests, vk_profile, blood_type, rh_factor, password) VALUES (:email,:name,:birth_date,:address,:sex,:interests,:vk_profile,:blood_type,:rh_factor,:password)";
    $stmt = $db->prepare($sql);
    $stmt->execute($data);
    header("Location: login.php");
    exit();
}

function userWithSameEmailExist(string $email) : bool
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    }
    return false;
}

function validate($userData): array
{
    $check = [
        0 => ""
    ];
    $patternPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_ !@#$%^&*()+,])[a-zA-Z\d!@#$%^&*()+,\-_\s]{6,}$/';
    if (empty($userData['email'])
        || empty($userData['name'])
        || empty($userData['birth_date'])
        || empty($userData['address'])
        || empty($userData['sex'])
        || empty($userData['interests'])
        || empty($userData['vk_profile'])
        || empty($userData['blood_type'])
        || empty($userData['rh_factor'])
        || empty($userData['password'])
        || empty($userData['password2'])) {
        $check[0] = "Не все поля формы заполнены";
    }
    if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
        $check[] = "Введен некорректный email";
    }
    if (!preg_match($patternPassword, $userData['password'])) {
        $check[] = " Неправильно введен пароль.Требования к паролю: длиннее 6 символов,
                    обязательно содержит большие латинские буквы, маленькие латинские буквы, спецсимволы (знаки
                    препинания, арифметические действия и тп), пробел, дефис, подчеркивание и цифры.";
    }
    if (strcmp($userData['password'], $userData['password2']) != 0) {
        $check[] = " Пароли не совпадают";
    }
    if (!filter_var($userData['vk_profile'], FILTER_VALIDATE_URL)) {
        $check[] = " Введена некорректная ссылка vk";
    }
    $patternBirthday = '/^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.\d{4}$/';
    if (!preg_match($patternBirthday, $userData['birth_date'])) {
        $check[] = " Введена некорректная дата рождения";
    }
    if (!empty($check[0]) || !empty($check[1]))
        return $check;
    if (userWithSameEmailExist($userData['email']))
        $check[] = 'Данная почта уже используется';
    return $check;
}

function defineSelected($variableName, $value) {
    return (isset($_POST[$variableName]) && $_POST[$variableName] === $value) ? "selected" : "";
}