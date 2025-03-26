<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fertilizers/product">Продукция</a></li>
        <li class="breadcrumb-item active">Редактировать продукт</li>
    </ol>
</nav>
<h1>Редактировать продукт</h1>

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
      action="/fertilizers/product/<?= intval($data[0]['currentItem']->getId()) ?>/edit"
>
    <div class="col-12">
        <div class="input-group">
            <!-- Название продукта -->
            <input type="text"
                   class="form-control"
                   placeholder="Название продукта"
                   name="setProductName"
                   maxlength="100"
                   value="<?= htmlspecialchars($data[0]['currentItem']->getProductName()) ?>">

            <!-- ID вида продукции -->
            <input type="number"
                   class="form-control"
                   placeholder="ID вида"
                   name="setProductTypeId"
                   value="<?= htmlspecialchars($data[0]['currentItem']->getProductTypeId()) ?>">
        </div>
    </div>
    <div class="col-12"><button class="btn btn-primary" type="submit">Сохранить</button></div>
</form>
