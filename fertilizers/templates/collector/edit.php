<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fertilizers/collector">Сборщики</a></li>
        <li class="breadcrumb-item active">Редактировать сборщика</li>
    </ol>
</nav>
<h1>Редактировать сборщика</h1>

<?php if(isset($data[1]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach($data[1]['error'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>

<form class="row row-cols-lg-auto g-3 align-items-center"
      method="post"
      action="/fertilizers/collector/<?= intval($data[0]['currentItem']->getId()) ?>/edit"
      enctype="multipart/form-data"
>
    <div class="col-12">
        <div class="input-group">
            <!-- Фото (загружается заново при необходимости) -->
            <input type="file" class="form-control" name="setCollectorPhoto">

            <input type="text" class="form-control"
                   placeholder="ФИО"
                   name="setCollectorFullName"
                   value="<?= htmlspecialchars($data[0]['currentItem']->getFullName()) ?>">

            <input type="number" class="form-control"
                   placeholder="ID Бригады"
                   name="setBrigadeId"
                   value="<?= htmlspecialchars($data[0]['currentItem']->getBrigadeId()) ?>">

            <input type="text" class="form-control"
                   placeholder="Характеристика"
                   name="setCollectorCharacteristic"
                   value="<?= htmlspecialchars($data[0]['currentItem']->getPersonalCharacteristic()) ?>">

            <input type="number" class="form-control"
                   placeholder="Год рождения"
                   name="setCollectorBirthYear"
                   value="<?= htmlspecialchars($data[0]['currentItem']->getBirthYear()) ?>">
        </div>
    </div>
    <div class="col-12"><button class="btn btn-primary" type="submit">Сохранить</button></div>
</form>
