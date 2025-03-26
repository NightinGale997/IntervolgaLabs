<?php

namespace models;

use models\Model;

class Collector extends Model
{
    protected $id;

    protected $photo;
    protected $full_name;

    protected $brigade_id;

    protected $personal_characteristic;

    protected $birth_year;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPhoto()
    {
        return $this->photo;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function getFullName()
    {
        return $this->full_name;
    }
    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    public function getBrigadeId()
    {
        return $this->brigade_id;
    }
    public function setBrigadeId($brigade_id)
    {
        $this->brigade_id = $brigade_id;
    }

    public function getPersonalCharacteristic()
    {
        return $this->personal_characteristic;
    }
    public function setPersonalCharacteristic($personal_characteristic)
    {
        $this->personal_characteristic = $personal_characteristic;
    }

    public function getBirthYear()
    {
        return $this->birth_year;
    }
    public function setBirthYear($birth_year)
    {
        $this->birth_year = $birth_year;
    }

    public static function getTableName()
    {
        return 'collectors';
    }
}
