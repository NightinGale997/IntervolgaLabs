<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fertilizers/product-type">Виды продукции</a></li>
        <li class="breadcrumb-item active">Новый вид продукции</li>
    </ol>
</nav>
<h1>Добавить вид продукции</h1>

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
      action="/fertilizers/product-type/add"
>
    <div class="col-12">
        <div class="input-group">
            <input type="text"
                   class="form-control"
                   placeholder="Название вида"
                   name="setProductTypeName"
                   maxlength="100">
        </div>
    </div>
    <div class="col-12"><button class="btn btn-primary" type="submit">Сохранить</button></div>
</form>
