<?php

namespace classes\models\harvests;

use classes\models\Model;

class Harvest extends Model
{
    protected $id;
    protected $collector_id;
    protected $harvest_date;
    protected $quantity;
    protected $unit_of_measure;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCollectorId()
    {
        return $this->collector_id;
    }

    /**
     * @param mixed $collector_id
     */
    public function setCollectorId($collector_id): void
    {
        $this->collector_id = $collector_id;
    }

    /**
     * @return mixed
     */
    public function getHarvestDate()
    {
        return $this->harvest_date;
    }

    /**
     * @param mixed $harvest_date
     */
    public function setHarvestDate($harvest_date): void
    {
        $this->harvest_date = $harvest_date;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getUnitOfMeasure()
    {
        return $this->unit_of_measure;
    }

    /**
     * @param mixed $unit_of_measure
     */
    public function setUnitOfMeasure($unit_of_measure): void
    {
        $this->unit_of_measure = $unit_of_measure;
    }

    /**
     * Convert object to array
     * 
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'collector_id' => $this->collector_id,
            'harvest_date' => $this->harvest_date,
            'quantity' => $this->quantity,
            'unit_of_measure' => $this->unit_of_measure,
        ];
    }

    /**
     * Get database table name
     * 
     * @return string
     */
    public static function getTableName(): string
    {
        return 'harvests';
    }
}
