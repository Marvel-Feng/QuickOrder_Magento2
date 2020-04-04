<?php

namespace Sergg\QuickOrder\Block;

use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;

class QuickOrder extends Template
{
    /**
     * @var Product
     */
    protected $_product;

    protected $registry;

    /**
     * QuickOrder constructor.
     * @param Template\Context $context
     * @param Product $product
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Product $product,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_product = $product;
        $this->registry = $registry;
    }

    /**
     * @return string
     */
    public function getProductSku()
    {
        return $this->registry->registry('current_product')->getSku();
    }

    /**
     * @param $product
     * @return $this
     */
    public function setProduct($product)
    {
        $this->_product = $product;

        return $this;
    }
}
