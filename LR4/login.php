<?php
require_once 'session/sessionStart.php';
require_once 'loginLogic.php';
$valuesFromPost = getValuesFromPost();
if (isset($_POST['loginButton'])) {
    $errors = enterInAccount($valuesFromPost);
}
?>

<?php include "./layout/header.php"?>
<div id="main-page" class="d-flex flex-column align-items-center m-0 p-0 px-4">
    <div class="my-5 px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            <span class="opacity-25"><span class="primary-text">С</span>Е<span class="primary-text">М</span>Е<span class="primary-text">Н</span>А<span class="primary-text">!</span></span> <br />
                            <span class="primary-text">СЕМЕНА!</span> <br />
                            <span class="opacity-25">С<span class="primary-text">Е</span>М<span class="primary-text">Е</span>Н<span class="primary-text">А</span>!</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Если у вас нет аккаунта, то срочно заведите аккаунт для удобной закупки кучи семян! <a href="signup.php">Зарегистрироваться</a>
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5 text-center">
                                <h2 class="text-center fw-bold">Вход</h2>
                                <form action="login.php" method="post">
                                    <!-- Email input -->
                                    <div class="form-outline mb-4 text-start">
                                        <label class="form-label" for="email">Почта</label>
                                        <input placeholder="Введите почту..." name="email" type="email" class="form-control" />
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4 text-start">
                                        <label class="form-label" for="password">Пароль</label>
                                        <input placeholder="Введите пароль..." name="password" type="password" class="form-control" />
                                    </div>

                                    <!-- Submit button -->
                                    <button name="loginButton" type="submit" class="btn btn-primary primary-btn primary-color border-0 btn-block mb-4 px-5">
                                        Войти
                                    </button>
                                </form>
                                <?php if (isset($_POST['loginButton']) && !empty($errors) && $errors[0]): ?>
                                    <div class="alert alert-danger"><?= $errors[0] ?></div>
                                <?php elseif (isset($_POST['loginButton']) && !empty($errors)): ?>
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