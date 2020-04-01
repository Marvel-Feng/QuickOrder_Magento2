<?php


namespace Sergg\QuickOrder\Model;

use Magento\Framework\Model\AbstractModel;
use Sergg\QuickOrder\Api\Model\QuickOrderInterface;
use Sergg\QuickOrder\Model\ResourceModel\QuickOrder as ResourceModel;

/**
 * Class QuickOrder
 * @package Sergg\QuickOrder\Model
 */
class QuickOrder extends AbstractModel implements QuickOrderInterface
{
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}