<?php

namespace Sergg\QuickOrder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class QuickOrder
 * @package Sergg\QuickOrder\Model\ResourceModel
 */
class QuickOrder extends AbstractDb
{
    public function _construct()
    {
        $this->_init('sergg_quickorder', 'order_id');
    }

}