<?php

namespace controllers;

use services\db;

class MainController
{
    protected $model;

    public function __construct($modelClass = null){
        if(isset($modelClass)){
            $this->model = new $modelClass;
        }
    }

    public function actionList(): void
    {
        $items = $this->model->getAll();
        include 'templates/' . (new \ReflectionClass($this->model))->getShortName() . '/list.php';
    }

    public function actionAdd(): void
    {
        $modelName = (new \ReflectionClass($this->model))->getShortName();
        $modelNameKebab = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', (new \ReflectionClass($this->model))->getShortName()));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item = new $this->model;

            $errors = $this->validateFields($this->getRequiredFields(), $_POST, $_FILES);

            if (empty($errors)) {
                $this->setModelProperties($item, $_POST, $_FILES);


                if (empty($item->getError())) {
                    $item->save();
                    header('Location: /fertilizers/' . $modelNameKebab);
                    exit();
                } else {
                    $errors[] = $item->getError();
                    $data[0]['error'] = $errors;
                }
            } else {
                $data[0]['error'] = $errors;
            }
        }
        include 'templates/' . $modelName . '/add.php';
    }


    public function actionEdit($id = null): void
    {
        $modelName = (new \ReflectionClass($this->model))->getShortName();
        $modelNameKebab = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', (new \ReflectionClass($this->model))->getShortName()));

        $item = $this->model->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validateFields($this->getRequiredFields(), $_POST, $_FILES);

            if (empty($errors)) {
                $this->setModelProperties($item, $_POST, $_FILES);
                if (empty($item->getError())) {
                    $item->update();
                    header('Location: /fertilizers/' . $modelNameKebab);
                    exit();
                } else {
                    $errors[] = $item->getError();
                    $data[1]['error'] = $errors;
                }
            } else {
                $data[1]['error'] = $errors;
            }
            $data[0]['currentItem'] = $item;
        } else {
            $data[0]['currentItem'] = $item;
        }
        include 'templates/' . $modelName . '/edit.php';
    }

    public function actionDelete($id = null): void
    {
        $this->model->delete($id);
        $modelNameKebab = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', (new \ReflectionClass($this->model))->getShortName()));
        header('Location: /fertilizers/' . $modelNameKebab);
        exit();
    }

    protected function setModelProperties($item, $postData, $fileData = null): void
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

    public function getDetailedData()
    {
        // Пример джойна HarvestJournal + Collector + Brigade + Product + ProductType
        $db = db::getInstance();
        $sql = "
        SELECT
            hj.id AS journal_id,
            hj.harvest_date,
            hj.quantity,
            hj.unit_of_measure,
            c.full_name AS collector_full_name,
            c.photo AS collector_photo,
            b.brigade_name,
            p.product_name,
            pt.product_type_name
        FROM harvest_journal hj
        LEFT JOIN collectors c ON hj.collector_id = c.id
        LEFT JOIN brigades b ON c.brigade_id = b.id
        LEFT JOIN products p ON hj.product_id = p.id
        LEFT JOIN product_types pt ON p.product_type_id = pt.id";
        return $db->query($sql, []);
    }

    public function actionDetailedList(): void
    {
        $items = $this->getDetailedData();
        include 'templates/allInfo/allInfo.php';
    }
}