<?php

namespace classes\models\collectors;

use classes\models\Model;

class Collector extends Model
{
    protected $id;
    protected $photo;
    protected $full_name;
    protected $personal_characteristic;
    protected $birth_year;

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
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @param mixed $full_name
     */
    public function setFullName($full_name): void
    {
        $this->full_name = $full_name;
    }

    /**
     * @return mixed
     */
    public function getPersonalCharacteristic()
    {
        return $this->personal_characteristic;
    }

    /**
     * @param mixed $personal_characteristic
     */
    public function setPersonalCharacteristic($personal_characteristic): void
    {
        $this->personal_characteristic = $personal_characteristic;
    }

    /**
     * @return mixed
     */
    public function getBirthYear()
    {
        return $this->birth_year;
    }

    /**
     * @param mixed $birth_year
     */
    public function setBirthYear($birth_year): void
    {
        $this->birth_year = $birth_year;
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
            'photo' => $this->photo,
            'full_name' => $this->full_name,
            'personal_characteristic' => $this->personal_characteristic,
            'birth_year' => $this->birth_year,
        ];
    }

    /**
     * Get database table name
     * 
     * @return string
     */
    public static function getTableName(): string
    {
        return 'collectors';
    }
}
