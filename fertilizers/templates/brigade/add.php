<?php include_once __DIR__. "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fertilizers/brigade">Бригады</a></li>
        <li class="breadcrumb-item active">Добавить бригаду</li>
    </ol>
</nav>
<h1>Добавить бригаду</h1>

<?php if(isset($data[0]['error'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data[0]['error'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>

<form class="row row-cols-lg-auto g-3 align-items-center" name="addBrigade" method="post" action="/fertilizers/brigade/add">
    <div class="col-12">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Название бригады" name="setBrigadeName" maxlength="100">
        </div>
    </div>
    <div class="col-12"><button class="btn btn-primary" type="submit">Сохранить</button></div>
</form>
