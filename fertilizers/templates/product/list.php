<?php include_once __DIR__. "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Продукция</li>
    </ol>
</nav>
<h1>Список продукции</h1>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название продукта</th>
        <th>ID вида</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($items)): foreach($items as $product): ?>
        <tr>
            <td><?= intval($product->getId()) ?></td>
            <td><?= htmlspecialchars($product->getProductName()) ?></td>
            <td><?= htmlspecialchars($product->getProductTypeId()) ?></td>
            <td>
                <a class="btn btn-primary" href="/fertilizers/product/<?= intval($product->getId()) ?>/edit">Редактировать</a>
            </td>
            <td>
                <a class="btn btn-danger" href="/fertilizers/product/<?= intval($product->getId()) ?>/delete">Удалить</a>
            </td>
        </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>
<a class="btn btn-primary" href="/fertilizers/product/add">Добавить</a>
