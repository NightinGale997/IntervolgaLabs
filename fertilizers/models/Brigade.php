<?php

namespace models;

use models\Model;

class Brigade extends Model
{
    protected $id;

    protected $brigade_name;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getBrigadeName()
    {
        return $this->brigade_name;
    }

    public function setBrigadeName($brigade_name)
    {
        $this->brigade_name = $brigade_name;
    }

    public static function getTableName()
    {
        return 'brigades';
    }
}
