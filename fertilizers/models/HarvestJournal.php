<?php

namespace models;

use models\Model;

class HarvestJournal extends Model
{
    protected  $id;

    protected  $collector_id;

    protected  $product_id;

    protected  $harvest_date;

    protected  $quantity;

    protected  $unit_of_measure;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCollectorId()
    {
        return $this->collector_id;
    }
    public function setCollectorId($collector_id)
    {
        $this->collector_id = $collector_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    public function getHarvestDate()
    {
        return $this->harvest_date;
    }

    public function setHarvestDate($harvest_date)
    {
        $this->harvest_date = $harvest_date;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getUnitOfMeasure()
    {
        return $this->unit_of_measure;
    }
    public function setUnitOfMeasure($unit_of_measure)
    {
        $this->unit_of_measure = $unit_of_measure;
    }

    public static function getTableName()
    {
        return 'harvest_journal';
    }
}
