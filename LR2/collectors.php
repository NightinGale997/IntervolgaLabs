<?php
require_once 'logic.php';
$valuesFromGet = getValuesFromGET();
$collectors = getCollectorsFromDb();
$teams = getTeamsFromDb();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>Удобрения для растений и цветов купить по низкой цене в интернет-магазине Семь Семян</title>
</head>
<body>
<nav id="navbar" class="navbar navbar-main navbar-expand-lg bg-white p-3 pe-0">
    <div class="container-fluid pe-0">
        <a class="navbar-brand" href="#">
            <svg width="178" height="59" viewBox="0 0 178 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M57.0497 16.0378C52.7715 10.305 48.536 6.11234 48.3649 5.94121L47.4665 5.04278L46.5681 5.94121C46.3969 6.11234 42.846 9.70605 38.9528 14.6688C35.1452 9.79161 31.5943 6.24069 31.2948 5.89843L30.3964 5L29.4979 5.89843C28.7706 6.62573 12 23.4392 12 35.4182C12 45.5576 20.257 53.8145 30.3964 53.8145C33.4767 53.8145 36.3859 53.0445 38.9528 51.7182C41.6481 53.0872 44.6001 53.8145 47.5093 53.8145C50.7607 53.8145 53.9266 52.9589 56.7075 51.376C62.3975 48.0817 65.9056 41.9639 65.9056 35.4182C65.8629 30.3699 62.9109 23.8242 57.0497 16.0378ZM47.4665 8.67927C48.8355 10.1339 51.6164 13.1286 54.3972 16.8079C51.0602 21.3428 48.75 25.4071 47.4237 29.0436C45.9263 24.851 43.231 20.5727 40.493 16.8079C43.3594 13.1714 46.0975 10.1339 47.4665 8.67927ZM30.3536 51.2904C21.626 51.2904 14.5242 44.1885 14.5242 35.461C14.5242 26.0489 26.8454 12.3585 30.3536 8.67927C31.7226 10.1339 34.4607 13.1286 37.2843 16.8079C31.8082 24.252 29.0701 30.4982 29.0701 35.461C29.0701 41.2366 31.8082 46.6699 36.3431 50.1353C34.4607 50.9054 32.4499 51.2904 30.3536 51.2904ZM31.6371 35.461C31.6371 31.2683 34.1612 25.5783 38.91 18.9898C42.7177 24.252 46.183 30.4554 46.183 35.461C46.183 41.0654 43.2738 45.9854 38.91 48.809C34.4179 45.8998 31.6371 40.8943 31.6371 35.461ZM55.3812 49.1941C52.9854 50.5631 50.2901 51.2904 47.4665 51.2904C45.4129 51.2904 43.4022 50.9054 41.477 50.0925C45.8835 46.7127 48.75 41.4077 48.75 35.461C48.75 31.2683 51.2741 25.621 56.0229 18.9898C60.7718 25.621 63.2959 31.2683 63.2959 35.461C63.2959 41.1938 60.3439 46.3277 55.3812 49.1941Z" fill="#14A97C"></path>
                <path d="M85.2004 28.9153C82.5479 28.9153 80.3233 28.0596 78.5692 26.3056C76.8151 24.5515 75.9595 22.3268 75.9595 19.6315C75.9595 16.9362 76.8151 14.7116 78.5692 13.0003C80.3233 11.2462 82.5479 10.3478 85.2004 10.3478C86.6123 10.3478 87.8957 10.6045 89.0936 11.1606C90.2915 11.7168 91.2755 12.4869 92.0884 13.5137C92.9012 14.5404 93.4574 15.6956 93.7997 17.0218H90.8049C90.3771 15.8239 89.6498 14.8827 88.6658 14.241C87.6818 13.5565 86.5267 13.2142 85.1577 13.2142C83.3608 13.2142 81.8634 13.8131 80.7083 15.0538C79.5104 16.2517 78.9542 17.8347 78.9542 19.7171C78.9542 21.5995 79.5532 23.1397 80.7083 24.3376C81.9062 25.5355 83.3608 26.1344 85.1577 26.1344C86.5267 26.1344 87.7246 25.7922 88.7086 25.0649C89.7354 24.3376 90.4199 23.3108 90.8049 22.0701H93.7997C93.3291 24.1664 92.3023 25.8777 90.7621 27.1184C89.2647 28.2735 87.3823 28.9153 85.2004 28.9153ZM99.9603 25.7922H107.747V28.573H97.0083V10.6045H107.447V13.3853H99.9603V18.0486H106.805V20.7867H99.9603V25.7922ZM132.689 28.573H129.694L127.598 15.5672L121.779 28.3163H121.052L115.191 15.5672L113.094 28.573H110.1L113.009 10.6045H115.918L121.394 22.8402L126.87 10.6045H129.78L132.689 28.573ZM142.785 16.594C144.582 16.594 146.08 17.1502 147.235 18.3053C148.39 19.4176 148.989 20.8722 148.989 22.6263C148.989 24.3376 148.39 25.7922 147.235 26.9045C146.08 28.0168 144.582 28.6158 142.785 28.6158H136.026V10.6473H138.978V16.6368H142.785V16.594ZM142.571 25.835C143.555 25.835 144.368 25.5355 145.01 24.9365C145.652 24.3376 145.994 23.5247 145.994 22.5835C145.994 21.6423 145.652 20.8722 145.01 20.2733C144.368 19.6743 143.555 19.3321 142.571 19.3321H138.978V25.7922H142.571V25.835ZM85.2004 52.8733C82.5479 52.8733 80.3233 52.0177 78.5692 50.2636C76.8151 48.5095 75.9595 46.2849 75.9595 43.5896C75.9595 40.8943 76.8151 38.6696 78.5692 36.9583C80.3233 35.2043 82.5479 34.3058 85.2004 34.3058C86.6123 34.3058 87.8957 34.5625 89.0936 35.1187C90.2915 35.6749 91.2755 36.4449 92.0884 37.4717C92.9012 38.4985 93.4574 39.6536 93.7997 40.9799H90.8049C90.3771 39.782 89.6498 38.8408 88.6658 38.199C87.6818 37.5145 86.5267 37.1722 85.1577 37.1722C83.3608 37.1722 81.8634 37.7712 80.7083 39.0119C79.5104 40.2098 78.9542 41.7927 78.9542 43.6751C78.9542 45.5576 79.5532 47.0977 80.7083 48.2956C81.9062 49.4935 83.3608 50.0925 85.1577 50.0925C86.5267 50.0925 87.7246 49.7502 88.7086 49.0229C89.7354 48.2956 90.4199 47.2688 90.8049 46.0282H93.7997C93.3291 48.1245 92.3023 49.8358 90.7621 51.0765C89.2647 52.2316 87.3823 52.8733 85.2004 52.8733ZM99.9603 49.7502H107.747V52.5311H97.0083V34.5625H107.447V37.3434H99.9603V42.0066H106.805V44.7447H99.9603V49.7502ZM132.689 52.5311H129.694L127.598 39.5253L121.779 52.2744H121.052L115.191 39.5253L113.094 52.5311H110.1L113.009 34.5625H115.918L121.394 46.7982L126.87 34.5625H129.78L132.689 52.5311ZM141.16 34.5625H148.304V52.5311H145.309V45.8998H141.972L138.165 52.5311H134.742L138.935 45.472C138.122 45.2153 137.438 44.8303 136.839 44.3169C136.282 43.8035 135.812 43.2045 135.512 42.52C135.213 41.8355 135.042 41.0654 135.042 40.2526C135.042 38.6268 135.641 37.3006 136.796 36.231C137.951 35.1187 139.406 34.5625 141.16 34.5625ZM141.288 43.2045H145.309V37.3434H141.288C140.347 37.3434 139.534 37.6001 138.935 38.1562C138.336 38.6696 138.036 39.3969 138.036 40.2526C138.036 41.1082 138.336 41.8355 138.935 42.3917C139.577 42.9478 140.347 43.2045 141.288 43.2045ZM164.048 34.5625H167V52.5311H164.048V44.7019H155.834V52.5311H152.882V34.5625H155.834V41.9211H164.048V34.5625Z" fill="#14A97C"></path>
            </svg>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex flex-row justify-content-evenly align-content-center w-100 h-100">
                <li class="nav-item nav-button-icon-first primary-color rounded-4 px-4 d-flex flex-row align-content-center align-middle">
                    <div class="text-center align-middle d-flex justify-content-center my-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" class="bi bi-grid" viewBox="0 0 16 16">
                            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
                        </svg>
                    </div>
                    <div class="my-auto d-flex justify-content-center">
                        <a class="nav-link active text-white fw-bold fs-5 text-center align-middle" aria-current="page" href="#">Каталог</a>
                    </div>
                </li>
                <li class="nav-item nav-button-icon-second align-middle">
                    <form class="d-flex form-control m-0 search-color p-0 align-content-center rounded-4 h-100" role="search">
                        <button class="btn user-select-none" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="grey" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                        <input class="w-100 shadow-none user-select-none border-0 search-color mx-2 fw-bold" type="search" placeholder="Поиск" aria-label="Search">
                    </form>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#53A17E" class="bi bi-boxes" viewBox="0 0 16 16">
                        <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z"/>
                    </svg>
                    <a class="nav-link fw-bold mx-2" href="#">Заказы</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#53A17E" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                    </svg>
                    <a class="nav-link fw-bold mx-2" href="#">Избранное</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#53A17E" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                    </svg>
                    <a class="nav-link fw-bold mx-2" href="#">Войти</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#53A17E" class="bi bi-bag" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                    </svg>
                    <a class="nav-link fw-bold mx-2" href="#">Корзина</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="header" class="subheader search-color d-flex flex-row justify-content-between px-4 mb-3">
    <div class="d-flex flex-row">
        <div class="mx-3 my-auto">
            <div class="fw-bold">Город: <a class="link-underline-opacity-50-hover link-dark">Москва</a></div>
        </div>
        <div class="mx-3 my-auto">
            <div class=" d-flex flex-row">
                <div class="mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="black" class="bi bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    </svg>
                </div>
                <a class="link-underline-opacity-50-hover link-dark">+7 (495) 104-21-81</a>
            </div>
        </div>
        <div class="callback-btn mx-0 my-auto">
            <button data-bs-toggle="modal" data-bs-target="#staticBackdrop2" class="secondary-color border-0 py-0 px-2 rounded-5 h-75 fw-bold">Обратный звонок</button>
        </div>
    </div>
    <div class="d-flex flex-row">
        <div class="mx-2 my-auto">
            <button class="border-0 py-0 px-2 bg-transparent">О компании</button>
        </div>
        <div class="mx-2 my-auto">
            <button class="border-0 py-0 px-2 bg-transparent">Доставка и оплата</button>
        </div>
        <div class="mx-2 my-auto">
            <button class="border-0 py-0 px-2 bg-transparent">Помощь</button>
        </div>
        <div class="mx-2 my-auto">
            <button class="border-0 py-0 px-2 bg-transparent">Как сделать заказ</button>
        </div>
        <div class="mx-2 my-auto">
            <button class="border-0 py-0 px-2 bg-transparent">Бонусная система</button>
        </div>
        <div class="mx-2 my-auto">
            <button class="border-0 py-0 px-2 bg-transparent">Пригласите друзей</button>
        </div>
        <div class="mx-2 my-auto">
            <button class="border-0 py-0 px-2 bg-transparent">Отзывы</button>
        </div>
        <div class="mx-2 my-auto">
            <button class="border-0 py-0 px-2 bg-transparent">Контакты</button>
        </div>
    </div>
</div>
<div id="main-page" class="d-flex flex-column align-items-center m-0 p-0 px-4">
    <form class="w-50 mb-5" action="collectors.php" method="get">
        <div class="mb-3">
            <label for="inputName" class="form-label">Имя</label>
            <input value="<?= $valuesFromGet['name']?>" name="name" type="text" class="form-control" id="inputName">
        </div>
        <div class="mb-3">
            <label for="inputSelect" class="form-label">Бригада</label>
            <select name="id_team" id="inputSelect" class="form-select">
                <option <?= empty($_GET['id_team']) ? 'selected' : '' ?> value="">Не выбрано</option>
                <?php foreach ($teams as $team): ?>
                    <option <?= isset($team['selected']) ? 'selected' : '' ?> value="<?=htmlspecialchars($team['id'])?>">
                        <?=htmlspecialchars($team['name'])?>
                    </option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="mb-3">
            <label for="inputPersonal" class="form-label">Персональная характеристика</label>
            <textarea name="personal_description" type="text" class="form-control" id="inputPersonal"><?=$valuesFromGet['personal_description']?></textarea>
        </div>
        <div class="mb-3">
            <label for="inputBirthDate" class="form-label">Дата рождения</label>
            <input value="<?= $valuesFromGet['birth_date']?>" name="birth_date" type="number" min="1935" max="2005" class="form-control" id="inputBirthDate">
        </div>
        <div class="d-flex flex-row">
            <button type="submit" class="btn btn-primary me-3">Применить фильтры</button>
            <a href="collectors.php" class="btn btn-danger">Сбросить фильтры</a>
        </div>
    </form>

    <table class="w-50 table table-hover">
        <thead>
            <tr class="row">
                <th scope="col" class="col-2">Фото</th>
                <th scope="col" class="col-3">ФИО</th>
                <th scope="col" class="col-2">Бригада</th>
                <th scope="col" class="col-3">Характеристика</th>
                <th scope="col" class="col-2">Дата рождения</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($collectors as $collector):?>
                <tr class="row">
                    <td class="col-2 d-block text-center">
                        <img height="100" src="catalogue/img/<?=htmlspecialchars($collector['img_path'])?>">
                    </td>
                    <td class="col-3"><?=htmlspecialchars($collector['name'])?></td>
                    <td class="col-2"><?=htmlspecialchars($collector['team'])?></td>
                    <td class="col-3"><?=htmlspecialchars($collector['personal_description'])?></td>
                    <td class="col-2"><?=htmlspecialchars($collector['birth_date'])?></td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>
<footer class="d-flex fw-bold flex-wrap justify-content-between align-items-center py-3 mt-4 border-top px-2">
    <div class="col-md-4 d-flex align-items-center">
        <span class="ms-4 text-body-secondary">© Семь семян, 2023</span>
    </div>
    <a href="http://dolyame.ru" class="text-decoration-none text-dark d-flex flex-row justify-content-end align-items-center text-center">
        <span class="fw-normal small">Поддержка сайта</span>
        <div class="developer__logo">
            <svg class="w-100 h-auto" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="242.877mm" height="37.9108mm" viewBox="0 0 93 20" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g>
                        <path d="M0.000732422 2.91169L4.17863 8.95879H0.000732422V18.971H4.54094V0.401367H0.000732422V2.91104V2.91169Z" fill="#969696"></path>
                        <path d="M19.3295 9.12774C21.1398 8.47161 22.031 7.13097 22.031 5.10581C22.031 3.53677 21.4743 2.36774 20.388 1.56903C19.3017 0.79871 17.7143 0.399355 15.6799 0.399355H7.71484V14.091L11.336 18.9974H15.3744C16.3212 18.9974 17.2125 18.9116 17.9926 18.769C18.803 18.6018 19.5891 18.3334 20.3325 17.9703C21.0842 17.5994 21.6694 17.0574 22.115 16.3445C22.5606 15.6316 22.7557 14.7755 22.7557 13.749C22.7557 11.3529 21.6132 9.81226 19.3295 9.12774ZM12.2828 4.25032H15.2349C15.8485 4.25032 16.3496 4.39226 16.7113 4.70645C17.073 5.02 17.2409 5.44839 17.2409 5.96129C17.2409 6.50323 17.073 6.90323 16.7113 7.21677C16.3496 7.53032 15.8756 7.6729 15.2349 7.6729L12.2828 7.64452V4.25032ZM15.5417 15.1465H12.2544V11.2671H15.5139C17.1292 11.2671 17.9371 11.9232 17.9371 13.2071C17.9371 14.491 17.1292 15.1465 15.5411 15.1465H15.5417ZM37.7119 13.1787L36.8206 11.8658C38.6593 10.8394 39.7734 9.09936 39.7734 6.64645C39.7734 5.47677 39.5783 4.47871 39.1605 3.62258C38.7426 2.7671 38.1575 2.11097 37.4335 1.68323C36.7095 1.22645 35.9016 0.912903 35.0659 0.712903C34.1717 0.502499 33.2559 0.397482 32.3372 0.4H24.956V2.90968L29.1333 8.95742H24.956V18.9981H29.4962V9.47032L33.924 15.8884C34.8431 17.029 36.1799 18.9684 40.0239 18.9684V14.3484C38.7148 14.3484 38.1575 13.8632 37.7119 13.1787ZM34.5647 8.38645C34.1469 8.75677 33.5895 8.95677 32.8662 8.95677H29.4956V4.64968H32.8662C33.5624 4.64968 34.1469 4.84968 34.5647 5.22C34.9826 5.59097 35.1776 6.1329 35.1776 6.81742C35.1776 7.50194 34.9826 8.01548 34.5647 8.38645ZM88.4595 0.399355V8.95677H81.7189V0.399355H77.1794V2.88065L81.3573 8.92839H77.1794V18.9677H81.7189V9.47097L84.3927 13.3503H88.4595V18.9981H92.9997V0.399355H88.4595ZM54.0062 11.6097C54.0062 13.8626 52.8915 14.9755 50.6356 14.9755C48.3797 14.9755 47.2657 13.8626 47.2657 11.6097V0.399355H42.7255V11.8948C42.7255 13.2355 42.9483 14.4045 43.4217 15.4032C43.8957 16.4013 44.508 17.1716 45.3159 17.7419C46.1017 18.2973 46.9779 18.7122 47.9057 18.9684C48.8254 19.2252 49.5771 19.3684 50.6356 19.3684C51.6942 19.3684 52.6687 19.2252 53.6161 18.9684C54.5352 18.7123 55.1481 18.2845 55.9554 17.7426C56.7633 17.1716 57.3762 16.4013 57.8496 15.4032C58.323 14.4052 58.5458 13.2355 58.5458 11.8948V0.399355H54.0056V11.6097H54.0062ZM72.4164 9.15613C71.7201 8.72839 70.6061 8.35742 69.7981 8.01548C68.9909 7.67355 68.2385 7.38774 67.5423 7.18839C66.846 6.98839 66.2609 6.73161 65.7875 6.44645C65.3141 6.16129 65.0913 5.81871 65.0913 5.44839C65.0913 4.67806 66.2054 4.05032 67.7651 4.02194C70.021 3.99355 71.9152 4.56387 73.4749 5.76194V1.48323C71.7201 0.485161 69.7148 0 67.3472 0C65.3697 0 63.7267 0.456129 62.4453 1.39742C61.164 2.33935 60.5233 3.67935 60.5233 5.44839C60.5233 6.67419 60.8579 7.70129 61.4985 8.58581C62.1386 9.44129 62.9187 10.0974 63.8655 10.5252C64.7845 10.9535 66.0381 11.3239 66.9571 11.6381C67.8762 11.9516 68.6563 12.2658 69.3248 12.6361C69.9654 12.9781 70.2993 13.4065 70.2993 13.8916C70.2993 14.3477 70.1049 14.8329 69.6871 15.0323C69.2692 15.2323 68.573 15.3174 67.6256 15.3174C65.2024 15.3174 62.6959 14.6335 60.7184 13.2355V17.7135C62.7237 18.8548 65.0358 19.4252 67.6818 19.4252C72.5281 19.4252 74.9228 17.5426 74.9228 13.749C74.9228 12.7219 74.7 11.809 74.2266 11.0394C73.6977 10.1832 73.1126 9.58387 72.4164 9.15613Z" fill="#969696"></path>
                    </g>
                </svg>
        </div>
    </a>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>