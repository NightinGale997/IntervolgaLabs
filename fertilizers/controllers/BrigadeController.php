<?php

namespace controllers;

use models\Brigade;

class BrigadeController extends MainController
{
    public function __construct()
    {
        // В конструкторе указываем, с какой моделью работаем
        parent::__construct(Brigade::class);
    }

    // Заполняем поля модели на основании данных из POST
    public function setModelProperties($item, $postData, $fileData = null): void
    {
        $item->setBrigadeName($postData['setBrigadeName']);
    }

    // Поля, обязательные для заполнения
    public function getRequiredFields(): array
    {
        return ['setBrigadeName'];
    }
}
