<?php

namespace controllers;

use models\Product;

class ProductController extends MainController
{
    public function __construct()
    {
        parent::__construct(Product::class);
    }

    public function setModelProperties($item, $postData, $fileData = null): void
    {
        $item->setProductName($postData['setProductName']);
        $item->setProductTypeId($postData['setProductTypeId']);
    }

    public function getRequiredFields(): array
    {
        return ['setProductName', 'setProductTypeId'];
    }
}
