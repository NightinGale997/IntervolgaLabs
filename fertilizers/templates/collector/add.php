<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fertilizers/collector">Сборщики</a></li>
        <li class="breadcrumb-item active">Новый сборщик</li>
    </ol>
</nav>
<h1>Добавить сборщика</h1>

<?php if(isset($data[0]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach($data[0]['error'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>

<form class="row row-cols-lg-auto g-3 align-items-center"
      method="post"
      action="/fertilizers/collector/add"
      enctype="multipart/form-data"
>
    <div class="col-12">
        <div class="input-group">
            <!-- Фото -->
            <input type="file" class="form-control" name="setCollectorPhoto">
            <!-- ФИО -->
            <input type="text" class="form-control" placeholder="ФИО" name="setCollectorFullName">
            <!-- ID Бригады -->
            <input type="number" class="form-control" placeholder="ID Бригады" name="setBrigadeId">
            <!-- Личная характеристика -->
            <input type="text" class="form-control" placeholder="Характеристика" name="setCollectorCharacteristic">
            <!-- Год рождения -->
            <input type="number" class="form-control" placeholder="Год рождения" name="setCollectorBirthYear">
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </div>
</form>
