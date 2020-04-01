<?php


namespace Sergg\QuickOrder\Model\ResourceModel\Status;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Sergg\QuickOrder\Model\Status as Model;
use Sergg\QuickOrder\Model\ResourceModel\Status as ResourceModel;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}