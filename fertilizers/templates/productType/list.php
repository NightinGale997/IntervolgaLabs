<?php include_once __DIR__. "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Виды продукции</li>
    </ol>
</nav>
<h1>Список видов продукции</h1>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название вида</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($items)): foreach($items as $pt): ?>
        <tr>
            <td><?= intval($pt->getId()) ?></td>
            <td><?= htmlspecialchars($pt->getProductTypeName()) ?></td>
            <td>
                <a class="btn btn-primary" href="/fertilizers/product-type/<?= intval($pt->getId()) ?>/edit">Редактировать</a>
            </td>
            <td>
                <a class="btn btn-danger" href="/fertilizers/product-type/<?= intval($pt->getId()) ?>/delete">Удалить</a>
            </td>
        </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>
<a class="btn btn-primary" href="/fertilizers/product-type/add">Добавить</a>
