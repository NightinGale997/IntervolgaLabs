<?php include_once __DIR__. "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fertilizers/harvest-journal">Журнал урожая</a></li>
        <li class="breadcrumb-item active">Новая запись</li>
    </ol>
</nav>
<h1>Добавить запись в журнал</h1>

<?php if(isset($data[0]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data[0]['error'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>

<form class="row row-cols-lg-auto g-3 align-items-center"
      method="post"
      action="/fertilizers/harvest-journal/add"
>
    <div class="col-12">
        <div class="input-group">
            <!-- ID сборщика -->
            <input type="number" class="form-control" placeholder="ID сборщика" name="setCollectorId">
            <!-- ID продукта -->
            <input type="number" class="form-control" placeholder="ID продукта" name="setProductId">
            <!-- Дата сбора -->
            <input type="date" class="form-control" name="setHarvestDate">
            <!-- Количество -->
            <input type="number" class="form-control" placeholder="Количество" name="setQuantity">
            <!-- Единица измерения -->
            <input type="text" class="form-control" placeholder="Ед. измерения (кг/шт)" name="setUnitOfMeasure">
        </div>
    </div>
    <div class="col-12"><button class="btn btn-primary" type="submit">Сохранить</button></div>
</form>
