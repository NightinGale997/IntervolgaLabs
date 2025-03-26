<?php include_once __DIR__. "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fertilizers/harvest-journal">Журнал урожая</a></li>
        <li class="breadcrumb-item active">Редактировать запись</li>
    </ol>
</nav>
<h1>Редактировать запись</h1>

<?php if(isset($data[1]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data[1]['error'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>

<form class="row row-cols-lg-auto g-3 align-items-center"
      method="post"
      action="/fertilizers/harvest-journal/<?= intval($data[0]['currentItem']->getId()) ?>/edit"
>
    <div class="col-12">
        <div class="input-group">
            <!-- ID сборщика -->
            <input type="number" class="form-control"
                   placeholder="ID сборщика"
                   name="setCollectorId"
                   value="<?= htmlspecialchars($data[0]['currentItem']->getCollectorId()) ?>">

            <!-- ID продукта -->
            <input type="number" class="form-control"
                   placeholder="ID продукта"
                   name="setProductId"
                   value="<?= htmlspecialchars($data[0]['currentItem']->getProductId()) ?>">

            <!-- Дата сбора -->
            <input type="date" class="form-control"
                   name="setHarvestDate"
                   value="<?= htmlspecialchars($data[0]['currentItem']->getHarvestDate()) ?>">

            <!-- Количество -->
            <input type="number" class="form-control"
                   placeholder="Количество"
                   name="setQuantity"
                   value="<?= htmlspecialchars($data[0]['currentItem']->getQuantity()) ?>">

            <!-- Ед. измерения -->
            <input type="text" class="form-control"
                   placeholder="Ед. измерения"
                   name="setUnitOfMeasure"
                   value="<?= htmlspecialchars($data[0]['currentItem']->getUnitOfMeasure()) ?>">
        </div>
    </div>
    <div class="col-12"><button class="btn btn-primary" type="submit">Сохранить</button></div>
</form>
