<?php include_once __DIR__. "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Бригады</li>
    </ol>
</nav>
<h1>Список бригад</h1>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название бригады</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($items)): foreach($items as $brigade): ?>
        <tr>
            <td><?= intval($brigade->getId()) ?></td>
            <td><?= htmlspecialchars($brigade->getBrigadeName()) ?></td>
            <td>
                <a class="btn btn-primary" href="/fertilizers/brigade/<?= intval($brigade->getId()) ?>/edit">Редактировать</a>
            </td>
            <td>
                <a class="btn btn-danger" href="/fertilizers/brigade/<?= intval($brigade->getId()) ?>/delete">Удалить</a>
            </td>
        </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>
<a class="btn btn-primary" href="/fertilizers/brigade/add">Добавить</a>
