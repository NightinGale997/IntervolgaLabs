<?php

namespace classes\controllers;

use classes\models\collectors\Collector;
use classes\models\harvests\Harvest;
use classes\services\db;

class HarvestController extends MainController
{
    public function __construct()
    {
        parent::__construct(Harvest::class);
    }

    public function actionAdd(array $requestData = []): array
    {
        $errors = $this->validateFields($this->getRequiredFields(), $requestData);

        if (!empty($errors)) {
            return ["errors" => $errors];
        }

        $itemClass = get_class($this->model);
        $item = new $itemClass;

        $this->setModelProperties($item, $requestData);

        if (!empty($item->getError())) {
            return ["errors" => "second_block"];
        }

        $item->save();

        return $item->toArray();
    }

    public function actionEdit($id = null, array $data = []): array
    {
        $item = $this->model->getById($id);

        $errors = $this->validateFields($this->getRequiredFields(), $data);

        if (!empty($errors)) {
            return ["errors" => $errors];
        }

        $this->setModelProperties($item, $data);

        if (!empty($item->getError())) {
            return ["errors" => "second_block"];
        }

        $item->update();

        return $item->toArray();
    }

    public function setModelProperties($item, array $data = [], $fileData = null): void
    {
        $item->setCollectorId($data['collector_id']);
        $item->setHarvestDate($data['harvest_date']);
        $item->setQuantity($data['quantity']);
        $item->setUnitOfMeasure($data['unit_of_measure']);
    }

    public function actionFilter($collectorId)
    {
        $db = db::getInstance();
        $sql = "SELECT h.* 
                FROM harvests h
                JOIN collectors c ON h.collector_id = c.id
                WHERE h.collector_id = :collector";

        return $db->query($sql, [':collector' => $collectorId]);
    }

    public function getRequiredFields(): array
    {
        return ['collector_id', 'harvest_date', 'quantity', 'unit_of_measure'];
    }
}
