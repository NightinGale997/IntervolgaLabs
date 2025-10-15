<?php

namespace classes\controllers;

use classes\models\collectors\Collector;
use classes\services\db;

class CollectorController extends MainController
{
    public $class = \classes\models\collectors\Collector::class;

    public function __construct()
    {
        parent::__construct(Collector::class);
    }

    public function actionAdd($post_data, $file_data): array
    {
        $item = new $this->model;

        $errors = $this->validateFields($this->getRequiredFields(), $post_data, $file_data);

        if (!empty($errors)) {
            return ["errors" => $errors];
        }

        $this->setModelProperties($item, $post_data, $file_data);

        if (!empty($item->getError())) {
            return ["errors" => $item->getError()];
        }

        $item->save();

        return $item->toArray();
    }

    public function actionEdit($id, $post_data, $file_data): array
    {
        $item = $this->model->getById($id);

        $requiredFields = $this->getRequiredFields();

        $photoFieldKey = array_search('file:photo', haystack: $requiredFields);

        if ($photoFieldKey !== false && isset($post_data['photo'])) {
            unset($requiredFields[$photoFieldKey]);
            $requiredFields = array_values($requiredFields);
        }

        $errors = $this->validateFields($requiredFields, $post_data, $file_data);

        if (!empty($errors)) {
            return ["errors" => $errors];
        }

        $photoName = $item->getPhoto();

        $this->setModelProperties($item, $post_data, $file_data);

        if (!empty($item->getError())) {
            return ["errors" => $item->getError()];
        }

        $item->update();

        $photoPath = __DIR__ . '/../../templates/images/' . $photoName;
        if ($photoName !== $item->getPhoto() && !empty($photoName) && file_exists($photoPath)) {
            if (!unlink($photoPath)) {
                return ['error' => 'не удалось удалить фото'];
            }
        }

        return $item->toArray();
    }

    public function actionDelete($id = null): array
    {
        $item = $this->model->getById($id);
        $photoName = $item->getPhoto();

        $photoPath = __DIR__ . '/../../templates/images/' . $photoName;

        if (!empty($photoName) && file_exists($photoPath)) {
            if (!unlink($photoPath)) {
                return ['error' => 'не удалось удалить фото'];
            }
        }

        $this->model->delete($id);

        return ['status' => 'OK'];
    }

    public function actionFilter($full_name)
    {
        $db = db::getInstance();
        $sql = "SELECT * FROM collectors 
                WHERE full_name LIKE :search";

        return $db->query($sql, [':search' => "%{$full_name}%"]);
    }

    public function setModelProperties($item, $data, $fileData = null): void
    {
        $item->setFullName($data['full_name']);
        $item->setPersonalCharacteristic($data['personal_characteristic']);
        $item->setBirthYear($data['birth_year']);

        if (isset($fileData['photo'])) {
            $photoName = $fileData['photo']['name'];
            $photoTmpPath = $fileData['photo']['tmp_name'];

            $extension = pathinfo($photoName, PATHINFO_EXTENSION);
            $uniqueName = uniqid('photo_', true) . '.' . $extension;

            $photoDestination = __DIR__ . '/../../templates/images/' . $uniqueName;

            if (move_uploaded_file($photoTmpPath, $photoDestination)) {
                $item->setPhoto($uniqueName);
            } else {
                $item->addError("Ошибка загрузки фото.");
            }
        }
    }

    public function getRequiredFields(): array
    {
        $fields = ['full_name', 'personal_characteristic', 'birth_year'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fields[] = 'file:photo';
        }

        return $fields;
    }
}
