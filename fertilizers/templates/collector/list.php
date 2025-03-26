<?php include_once __DIR__. "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Сборщики</li>
    </ol>
</nav>
<h1>Список сборщиков</h1>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Фото</th>
        <th>ФИО</th>
        <th>Бригада (ID)</th>
        <th>Характеристика</th>
        <th>Год рождения</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($items)): foreach($items as $collector): ?>
        <tr>
            <td><?= intval($collector->getId()) ?></td>
            <td>
                <?php if($collector->getPhoto()): ?>
                    <img src="/fertilizers/templates/inc/images/<?= htmlspecialchars($collector->getPhoto()) ?>"
                         style="width: 80px; height: auto;">
                <?php else: ?>
                    Нет фото
                <?php endif;?>
            </td>
            <td><?= htmlspecialchars($collector->getFullName()) ?></td>
            <td><?= htmlspecialchars($collector->getBrigadeId()) ?></td>
            <td><?= htmlspecialchars($collector->getPersonalCharacteristic()) ?></td>
            <td><?= htmlspecialchars($collector->getBirthYear()) ?></td>
            <td>
                <a class="btn btn-primary" href="/fertilizers/collector/<?= intval($collector->getId()) ?>/edit">Редактировать</a>
            </td>
            <td>
                <a class="btn btn-danger" href="/fertilizers/collector/<?= intval($collector->getId()) ?>/delete">Удалить</a>
            </td>
        </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>
<a class="btn btn-primary" href="/fertilizers/collector/add">Добавить</a>
