<?php

namespace controllers;

use models\Collector;

class CollectorController extends MainController
{
    public function __construct()
    {
        parent::__construct(Collector::class);
    }

    public function setModelProperties($item, $postData, $fileData = null): void
    {
        // Примерно как в GoodController: если нужно загружать фото, проверяем $_FILES
        $item->setFullName($postData['setCollectorFullName']);
        $item->setBrigadeId($postData['setBrigadeId']);
        $item->setPersonalCharacteristic($postData['setCollectorCharacteristic']);
        $item->setBirthYear($postData['setCollectorBirthYear']);

        // Обработка изображения (если нужно):
        if (isset($fileData['setCollectorPhoto']) && $fileData['setCollectorPhoto']['error'] == UPLOAD_ERR_OK) {
            $imageName = $fileData['setCollectorPhoto']['name'];
            $tmpPath = $fileData['setCollectorPhoto']['tmp_name'];
            $destination = __DIR__ . '/../templates/inc/images/' . basename($imageName);

            if (move_uploaded_file($tmpPath, $destination)) {
                $item->setPhoto($imageName);
            } else {
                $item->addError("Ошибка при загрузке фото сборщика.");
            }
        }
    }

    public function getRequiredFields(): array
    {
        // Если добавляем нового сборщика, фото может быть обязательным
        // В зависимости от логики, можно делать по аналогии с GoodController
        return [
            'setCollectorFullName',
            'setBrigadeId',
            'setCollectorCharacteristic',
            'setCollectorBirthYear',
            'file:setCollectorPhoto'  // или убрать, если фото не обязательно
        ];
    }
}
