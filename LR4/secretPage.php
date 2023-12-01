<?php
require_once 'session/sessionStart.php';
require_once 'loginCheck.php';
require_once 'secretPageLogic.php';
$valuesFromGet = getValuesFromGet();
$collectors = getCollectorsFromDb();
$teams = getTeamsFromDb();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>Удобрения для растений и цветов купить по низкой цене в интернет-магазине Семь Семян</title>
</head>
<body>
<?php include "./layout/header.php"?>
<div id="main-page" class="d-flex flex-column align-items-center m-0 p-0 px-4">
    <form class="w-50 mb-5" action="secretPage.php" method="get">
        <div class="mb-3">
            <label for="inputName" class="form-label">Имя</label>
            <input value="<?= $valuesFromGet['name']?>" name="name" type="text" class="form-control" id="inputName">
        </div>
        <div class="mb-3">
            <label for="inputSelect" class="form-label">Бригада</label>
            <select name="id_team" id="inputSelect" class="form-select">
                <option <?= empty($_GET['id_team']) ? 'selected' : '' ?> value="">Не выбрано</option>
                <?php foreach ($teams as $team): ?>
                    <?php if ($team['id'] == $_GET['id_team']): ?>
                        <option selected value="<?=htmlspecialchars($team['id'])?>">
                            <?=htmlspecialchars($team['name'])?>
                        </option>
                    <?php else: ?>
                        <option value="<?=htmlspecialchars($team['id'])?>">
                            <?=htmlspecialchars($team['name'])?>
                        </option>
                    <?php endif ?>
                <?php endforeach;?>
            </select>
        </div>
        <div class="mb-3">
            <label for="inputPersonal" class="form-label">Персональная характеристика</label>
            <textarea name="personal_description" type="text" class="form-control" id="inputPersonal"><?=$valuesFromGet['personal_description']?></textarea>
        </div>
        <div class="mb-3">
            <label for="inputBirthDate" class="form-label">Дата рождения</label>
            <input value="<?= $valuesFromGet['birth_date']?>" name="birth_date" type="number" min="1935" max="2005" class="form-control" id="inputBirthDate">
        </div>
        <div class="d-flex flex-row">
            <button type="submit" class="btn btn-primary me-3">Применить фильтры</button>
            <a href="secretPage.php" class="btn btn-danger">Сбросить фильтры</a>
        </div>
    </form>

    <table class="w-50 table table-hover">
        <thead>
        <tr class="row">
            <th scope="col" class="col-2">Фото</th>
            <th scope="col" class="col-3">ФИО</th>
            <th scope="col" class="col-2">Бригада</th>
            <th scope="col" class="col-3">Характеристика</th>
            <th scope="col" class="col-2">Дата рождения</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($collectors as $collector):?>
            <tr class="row">
                <td class="col-2 d-block text-center">
                    <img height="100" src="catalogue/img/<?=htmlspecialchars($collector['img_path'])?>" alt="">
                </td>
                <td class="col-3"><?=htmlspecialchars($collector['name'])?></td>
                <td class="col-2"><?=htmlspecialchars($collector['team'])?></td>
                <td class="col-3"><?=htmlspecialchars($collector['personal_description'])?></td>
                <td class="col-2"><?=htmlspecialchars($collector['birth_date'])?></td>
            </tr>
        <?php endforeach?>
        </tbody>
    </table>
</div>
<?php include "./layout/footer.php"?>
</body>
</html>