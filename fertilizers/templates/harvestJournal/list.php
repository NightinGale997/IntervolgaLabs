<?php include_once __DIR__. "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Журнал урожая</li>
    </ol>
</nav>
<h1>Список записей в журнале</h1>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>ID сборщика</th>
        <th>ID продукта</th>
        <th>Дата сбора</th>
        <th>Количество</th>
        <th>Ед. изм.</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($items)): foreach($items as $hj): ?>
        <tr>
            <td><?= intval($hj->getId()) ?></td>
            <td><?= htmlspecialchars($hj->getCollectorId()) ?></td>
            <td><?= htmlspecialchars($hj->getProductId()) ?></td>
            <td><?= htmlspecialchars($hj->getHarvestDate()) ?></td>
            <td><?= htmlspecialchars($hj->getQuantity()) ?></td>
            <td><?= htmlspecialchars($hj->getUnitOfMeasure()) ?></td>
            <td>
                <a class="btn btn-primary" href="/fertilizers/harvest-journal/<?= intval($hj->getId()) ?>/edit">Редактировать</a>
            </td>
            <td>
                <a class="btn btn-danger" href="/fertilizers/harvest-journal/<?= intval($hj->getId()) ?>/delete">Удалить</a>
            </td>
        </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>
<a class="btn btn-primary" href="/fertilizers/harvest-journal/add">Добавить</a>
