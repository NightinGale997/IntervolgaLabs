<?php

namespace models;

use models\Model;

class Product extends Model
{
    protected  $id;

    protected  $product_name;

    protected  $product_type_id;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getProductName()
    {
        return $this->product_name;
    }
    public function setProductName($product_name)
    {
        $this->product_name = $product_name;
    }

    public function getProductTypeId()
    {
        return $this->product_type_id;
    }
    public function setProductTypeId($product_type_id)
    {
        $this->product_type_id = $product_type_id;
    }

    public static function getTableName()
    {
        return 'products';
    }
}
