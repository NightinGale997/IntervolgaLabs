<?php
require_once "TableModule.php";
$collectors = TableModule::GetCollectors();
require_once "layout/header.php";
?>
<h2 class="row justify-content-center mt-2 mb-3"> Список сборщиков:</h2>
<?php
if(isset($_GET['message'])): ?>
    <div class="alert alert-primary" role="alert"><?= htmlspecialchars($_GET['message'])?></div>
<?php endif;?>
<div class="container text-center mt-4">
    <table class="row">
        <tr class="row">
            <th class="col-3 text-center">Изображение</th>
            <th class="col-2 text-center">Имя</th>
            <th class="col-2 text-center">Команда</th>
            <th class="col-4 text-center">Описание</th>
            <th class="col-1 text-center">Год рождения</th>
        </tr>
        <?php foreach ($collectors as $collector):?>
            <tr class="mt-3 row ">
                <td class="col-3 d-flex flex-row justify-content-center">
                    <img class="TI" height="150" src="catalogue/img/<?= htmlspecialchars($collector['img_path'])?>">
                </td>
                <td class="col-2">
                    <?= htmlspecialchars($collector['name'])?>
                </td>
                <td class="col-2">
                    <?= htmlspecialchars($collector['team_name'])?>
                </td>
                <td class="col-4">
                    <?= htmlspecialchars($collector['personal_description'])?>
                </td>
                <td class="col-1">
                    <?= htmlspecialchars($collector['birth_date'])?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>
<div class="d-flex justify-content-center mt-3">
    <a href="AddCollector.php" class="btn btn-primary ">Добавить сборщика</a>
</div>
<?php require_once 'layout/footer.php'; ?>
