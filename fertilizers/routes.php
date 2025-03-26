<?php

use controllers\BrigadeController;
use controllers\CollectorController;
use controllers\ProductTypeController;
use controllers\ProductController;
use controllers\HarvestJournalController;
use controllers\MainController;

return [
    // Бригады
    '#^/fertilizers/brigade$#' => [BrigadeController::class, 'actionList'],
    '#^/fertilizers/brigade/add$#' => [BrigadeController::class, 'actionAdd'],
    '#^/fertilizers/brigade/(\d+)/edit$#' => [BrigadeController::class, 'actionEdit'],
    '#^/fertilizers/brigade/(\d+)/delete$#' => [BrigadeController::class, 'actionDelete'],

    // Сборщики
    '#^/fertilizers/collector$#' => [CollectorController::class, 'actionList'],
    '#^/fertilizers/collector/add$#' => [CollectorController::class, 'actionAdd'],
    '#^/fertilizers/collector/(\d+)/edit$#' => [CollectorController::class, 'actionEdit'],
    '#^/fertilizers/collector/(\d+)/delete$#' => [CollectorController::class, 'actionDelete'],

    // Виды продукции
    '#^/fertilizers/product-type$#' => [ProductTypeController::class, 'actionList'],
    '#^/fertilizers/product-type/add$#' => [ProductTypeController::class, 'actionAdd'],
    '#^/fertilizers/product-type/(\d+)/edit$#' => [ProductTypeController::class, 'actionEdit'],
    '#^/fertilizers/product-type/(\d+)/delete$#' => [ProductTypeController::class, 'actionDelete'],

    // Продукция
    '#^/fertilizers/product$#' => [ProductController::class, 'actionList'],
    '#^/fertilizers/product/add$#' => [ProductController::class, 'actionAdd'],
    '#^/fertilizers/product/(\d+)/edit$#' => [ProductController::class, 'actionEdit'],
    '#^/fertilizers/product/(\d+)/delete$#' => [ProductController::class, 'actionDelete'],

    // Журнал учёта
    '#^/fertilizers/harvest-journal$#' => [HarvestJournalController::class, 'actionList'],
    '#^/fertilizers/harvest-journal/add$#' => [HarvestJournalController::class, 'actionAdd'],
    '#^/fertilizers/harvest-journal/(\d+)/edit$#' => [HarvestJournalController::class, 'actionEdit'],
    '#^/fertilizers/harvest-journal/(\d+)/delete$#' => [HarvestJournalController::class, 'actionDelete'],

    // По умолчанию — например, показываем "детализированный" отчёт
    '#^#' => [MainController::class, 'actionDetailedList'],
];
