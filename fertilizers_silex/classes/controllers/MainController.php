<?php

namespace classes\controllers;

use classes\services\db;

class MainController
{
    protected $model;

    public function __construct($modelClass = null){
        $this->model = new $modelClass;
    }
    public function actionList(): array
    {
        $items = $this->model->getAll();
        return array_map(fn($item) => $item->toArray(), $items);
    }

    public function actionDelete($id = null): array
    {
        $this->model->delete($id);
        return ['status' => 'OK'];
    }
    protected function setModelProperties($item, array $data, $fileData = null): void
    {}

    public function getRequiredFields(): array
    {
        return [];
    }

    public function validateFields(array $requiredFields, array $postData, array $fileData = null): array
    {
        $errors = [];
        foreach ($requiredFields as $field) {
            if (str_starts_with($field, 'file:')) {
                $fileField = substr($field, 5);
                if (empty($fileData[$fileField]) || $fileData[$fileField]['error'] != UPLOAD_ERR_OK) {
                    $errors[] = "Поле \"" . $fileField . "\" обязательно для загрузки.";
                }
            } else {
                if (empty($postData[$field])) {
                    $errors[] = "Поле \"" . $field . "\" обязательно для заполнения.";
                }
            }
        }
        return $errors;
    }
}