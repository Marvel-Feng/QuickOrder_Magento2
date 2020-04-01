<?php

namespace Sergg\QuickOrder\Model\ResourceModel\QuickOrder;

use Sergg\QuickOrder\Model\ResourceModel\QuickOrder as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Sergg\QuickOrder\Model\QuickOrder as Model;

/**
 * Class Collection
 * @package Sergg\QuickOrder\Model\ResourceModel\QuickOrder
 */
class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}