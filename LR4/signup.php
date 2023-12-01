<?php
require_once 'session/sessionStart.php';
require_once 'signupLogic.php';
$valuesFromPost = getValuesFromPost();
if (isset($_POST['signupButton'])) {
    $errors = addUserInDb($valuesFromPost);
}
?>

<?php include "./layout/header.php"?>
<div id="main-page" class="d-flex flex-column align-items-center m-0 p-0 px-4">
    <div class="my-5 px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
        <div class="container">
            <div class="row gx-lg-5 align-items-start">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        <span class="opacity-25"><span class="primary-text">С</span>Е<span class="primary-text">М</span>Е<span class="primary-text">Н</span>А<span class="primary-text">!</span></span> <br />
                        <span class="primary-text">СЕМЕНА!</span><br />
                        <span class="opacity-25">С<span class="primary-text">Е</span>М<span class="primary-text">Е</span>Н<span class="primary-text">А</span>!</span>
                    </h1>
                    <p style="color: hsl(217, 10%, 50.8%)">
                        Если у вас уже есть аккаунт, то войдите здесь и покупайте сколько угодно семян!!!! <a href="login.php">Войти</a>
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5 text-center">
                            <h2 class="text-center fw-bold">Регистрация</h2>
                            <form action="signup.php" method="post">
                                <!-- Email input -->
                                <div class="w-100 text-start pb-3">
                                    <label for="email" class="pb-3">Email</label>
                                    <input type="text" name="email" class="form-control" value="<?= $valuesFromPost['email'] ?>"
                                           placeholder="example@example.com">
                                </div>
                                <div class="w-100 text-start pb-3">
                                    <label for="name" class="pb-3">ФИО</label>
                                    <input type="text" name="name" class="form-control" value="<?= $valuesFromPost['name'] ?>"
                                           placeholder="Иванов Иван Иванович">
                                </div>
                                <div class="w-100 text-start pb-3">
                                    <label for="birth_date" class="pb-3">Дата Рождения</label>
                                    <input type="text" name="birth_date" class="form-control" value="<?= $valuesFromPost['birth_date'] ?>"
                                           placeholder="01.01.2001">
                                </div>
                                <div class="w-100 text-start pb-3">
                                    <label for="address" class="pb-3">Адрес</label>
                                    <input type="text" name="address" class="form-control" value="<?= $valuesFromPost['address'] ?>"
                                           placeholder="Ленинградская область, город Щёлково, спуск Домодедовская, 83">
                                </div>
                                <div class="w-100 text-start pb-3">
                                    <label class="pb-3" for="sex">Пол</label>
                                    <select name="sex" id="gender" class="form-control">
                                        <option value="" selected>Выберите пол</option>
                                        <option value="мужской"<?= defineSelected('sex', "мужской") ?>>
                                            мужской
                                        </option>
                                        <option value="женский"<?= defineSelected('sex', "женский") ?>>
                                            женский
                                        </option>
                                    </select>
                                </div>
                                <div class="w-100 text-start pb-3">
                                    <label class="pb-3" for="interests">Интересы</label>
                                    <textarea class="form-control" placeholder="Введите свои интересы"
                                              name="interests"><?= $valuesFromPost['interests'] ?></textarea>
                                </div>
                                <div class="w-100 text-start pb-3">
                                    <label class="pb-3" for="vk_profile">Введите ссылку на профиль вк</label>
                                    <input type="text" name="vk_profile" class="form-control" value="<?= $valuesFromPost['vk_profile'] ?>"
                                           placeholder="https://vk.com/semen">
                                </div>
                                <div class="w-100 text-start pb-3">
                                    <label class="pb-3" for="blood_type">Группа крови</label>
                                    <select name="blood_type" id="blood_type" class="form-control">
                                        <option value="" selected>Группа крови</option>
                                        <option value="О(I)" <?= defineSelected('blood_type', "О(I)") ?>>
                                            О(I)
                                        </option>
                                        <option value="А(II)" <?= defineSelected('blood_type', "А(II)") ?>>
                                            А(II)
                                        </option>
                                        <option value="В(III)" <?= defineSelected('blood_type', "В(III)") ?>>
                                            В(III)
                                        </option>
                                        <option value="АВ(IV)" <?= defineSelected('blood_type', "АВ(IV)") ?>>
                                            АВ(IV)
                                        </option>
                                    </select>

                                </div>
                                <div class="w-100 text-start pb-3">
                                    <label class="pb-3" for="rh_factor">Резус-фактор</label>
                                    <select name="rh_factor" id="factor" class="form-control">
                                        <option value="" selected>Резус-фактор</option>
                                        <option value="Положительный(+)" <?= defineSelected('rh_factor', "Положительный(+)") ?>>
                                            Положительный(+)
                                        </option>
                                        <option value="Отрицательный(-)" <?= defineSelected('rh_factor', "Отрицательный(-)") ?>>
                                            Отрицательный(-)
                                        </option>
                                    </select>
                                </div>
                                <div class="w-100 text-start pb-3">
                                    <label for="password" class="pb-3">Пароль</label>
                                    <input type="password" name="password" class="form-control " placeholder="Введите пароль">
                                </div>
                                <div class="w-100 text-start pb-3">
                                    <label for="password2" class="pb-3">Подтвердите пароль</label>
                                    <input type="password" name="password2" class="form-control " placeholder="Введите пароль еще раз">
                                </div>

                                <!-- Submit button -->
                                <button name="signupButton" type="submit" class="btn btn-primary primary-btn primary-color border-0 btn-block mb-4 px-5">
                                    Зарегистрироваться
                                </button>
                            </form>
                            <?php if (isset($_POST['signupButton']) && !empty($errors) && $errors[0]): ?>
                                <div class="alert alert-danger"><?= $errors[0] ?></div>
                            <?php elseif (isset($_POST['signupButton']) && !empty($errors)): ?>
                                <?php foreach ($errors as $value): ?>
                                    <?php if (!empty($value)): ?>
                                        <div class="alert alert-danger"><?= $value ?></div>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "./layout/footer.php"?>