<?php

namespace models;

use services\db;

class Model
{
    public $error = [];

    public function save()
    {
        $array = $this->constructData();
        $db = db::getInstance();
        $sql = "INSERT INTO ".static::getTableName()." (". $array["dbColumns"] .") VALUES (". $array["params"] .")";
        $db->query($sql, $array["values"]);
        $this->error = $db->getError();
        if (!empty($db->getError())) {
            // Вывести ошибки
            var_dump($db->getError());
            die;
        }
    }

    public function update()
    {
        $array = $this->constructData();
        $db = db::getInstance();
        $sql = "UPDATE ".static::getTableName(). " SET ".$array["updateColumns"]." WHERE id = :id";
        $db->query($sql, $array["values"]);
        $this->error = $db->getError();
    }

    public function getById($id){
        $db = db::getInstance();
        $sql = "SELECT * FROM ".static::getTableName()." WHERE id = :id";
        $result = $db->query($sql, ["id" => $id],static::class);
        return $result ? $result[0] : null;
    }

    public function getAll(){
        $db = db::getInstance();
        $sql = "SELECT * FROM ".static::getTableName();
        $result = $db->query($sql,[],static::class);
        return $result ? $result : null;
    }

    public function delete($id)
    {
        $db = db::getInstance();
        $sql = "DELETE FROM ".static::getTableName()." WHERE id = :id";
        $db->query($sql, ["id" => $id]);
    }

    public function addError($error)
    {
        $this->error = $error;
    }
    public function getError(): array
    {
        return $this->error;
    }
    public function constructData()
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $valuePart = [];
        $dbColumns = [];
        $params = [];
        $updateColumns = [];
        foreach ($properties as $property) {
            if($property->getName()!="error")
            {
                $propertyName = $property->getName();
                $propertyValue = $this->$propertyName;

                $params [] = ":" . $propertyName;
                $valuePart[":" . $propertyName] = $propertyValue;
                $dbColumns[] = $propertyName;

                $updateColumns [] = $propertyName . "=:" . $propertyName;
            }

        }
        $builtData["values"] = $valuePart;
        $builtData["dbColumns"] = implode(",", $dbColumns);
        $builtData["params"] = implode(",", $params);
        $builtData["updateColumns"] = implode(",", $updateColumns);
        return $builtData;
    }
}