<?php

namespace controllers;

use models\ProductType;

class ProductTypeController extends MainController
{
    public function __construct()
    {
        parent::__construct(ProductType::class);
    }

    public function setModelProperties($item, $postData, $fileData = null): void
    {
        $item->setProductTypeName($postData['setProductTypeName']);
    }

    public function getRequiredFields(): array
    {
        return ['setProductTypeName'];
    }
}
