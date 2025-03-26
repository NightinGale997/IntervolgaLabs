<?php include_once __DIR__ . "/../inc/header.html"; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fertilizers/product">Продукция</a></li>
        <li class="breadcrumb-item active">Новый продукт</li>
    </ol>
</nav>
<h1>Добавить продукт</h1>

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
      action="/fertilizers/product/add"
>
    <div class="col-12">
        <div class="input-group">
            <!-- Название продукта -->
            <input type="text"
                   class="form-control"
                   placeholder="Название продукта"
                   name="setProductName"
                   maxlength="100">

            <!-- ID вида продукции -->
            <input type="number"
                   class="form-control"
                   placeholder="ID вида"
                   name="setProductTypeId">
        </div>
    </div>
    <div class="col-12"><button class="btn btn-primary" type="submit">Сохранить</button></div>
</form>
