<?php

namespace controllers;

use models\HarvestJournal;

class HarvestJournalController extends MainController
{
    public function __construct()
    {
        parent::__construct(HarvestJournal::class);
    }

    public function setModelProperties($item, $postData, $fileData = null): void
    {
        $item->setCollectorId($postData['setCollectorId']);
        $item->setProductId($postData['setProductId']);
        $item->setHarvestDate($postData['setHarvestDate']);
        $item->setQuantity($postData['setQuantity']);
        $item->setUnitOfMeasure($postData['setUnitOfMeasure']);
    }

    public function getRequiredFields(): array
    {
        return ['setCollectorId', 'setProductId', 'setHarvestDate', 'setQuantity'];
        // unit_of_measure можно сделать необязательным, если хотите.
    }
}
