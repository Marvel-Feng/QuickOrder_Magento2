<?php

namespace Sergg\QuickOrder\Controller\Adminhtml\Status;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Listing
 * @package Sergg\QuickOrder\Controller\Adminhtml\Status
 */
class Listing extends Action
{
    /** {@inheritDoc} */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }

    /**
     * @return bool
     */
    public function _isAllowed()
    {
        return parent::_isAllowed();
    }
}