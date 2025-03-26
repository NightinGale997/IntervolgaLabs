<?php include_once __DIR__ . "/../inc/header.html"; ?>

<h1>Детализированная информация о сборах урожая</h1>

<table class="table">
    <thead>
    <tr>
        <th>ID записи</th>
        <th>Дата сбора</th>
        <th>Количество</th>
        <th>Ед. изм.</th>
        <th>Сборщик</th>
        <th>Фото</th>
        <th>Бригада</th>
        <th>Продукт</th>
        <th>Вид продукта</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($items)): ?>
        <?php foreach ($items as $item): ?>
            <tr>
                <!-- Поле hj.id AS journal_id -->
                <td><?= htmlspecialchars($item['journal_id']) ?></td>

                <!-- Дата сбора -->
                <td><?= htmlspecialchars($item['harvest_date']) ?></td>

                <!-- Количество -->
                <td><?= htmlspecialchars($item['quantity']) ?></td>

                <!-- Ед. измерения -->
                <td><?= htmlspecialchars($item['unit_of_measure']) ?></td>

                <!-- ФИО сборщика -->
                <td><?= htmlspecialchars($item['collector_full_name']) ?></td>

                <!-- Фото сборщика -->
                <td>
                    <?php if (!empty($item['collector_photo'])): ?>
                        <img src="/fertilizers/templates/inc/images/<?= htmlspecialchars($item['collector_photo']) ?>"
                             alt="Фото сборщика"
                             style="width: 80px; height: auto;">
                    <?php else: ?>
                        Нет фото
                    <?php endif; ?>
                </td>

                <!-- Название бригады -->
                <td><?= htmlspecialchars($item['brigade_name']) ?></td>

                <!-- Название продукта -->
                <td><?= htmlspecialchars($item['product_name']) ?></td>

                <!-- Вид продукта -->
                <td><?= htmlspecialchars($item['product_type_name']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
