<?php

namespace models;

use models\Model;

class ProductType extends Model
{
    protected  $id;

    protected  $product_type_name;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getProductTypeName()
    {
        return $this->product_type_name;
    }
    public function setProductTypeName($product_type_name)
    {
        $this->product_type_name = $product_type_name;
    }

    public static function getTableName()
    {
        return 'product_types';
    }
}
