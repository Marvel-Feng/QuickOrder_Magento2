<?php


namespace Sergg\QuickOrder\DataProvider;

use Magento\Ui\DataProvider\ModifierPoolDataProvider;
use Magento\Framework\App\Request\DataPersistorInterface;
use Sergg\QuickOrder\Api\Model\QuickOrderInterface;
use Sergg\QuickOrder\Model\ResourceModel\QuickOrder\Collection;
use Sergg\QuickOrder\Model\ResourceModel\QuickOrder\CollectionFactory;



class QuickOrderProvider extends ModifierPoolDataProvider
{
    /**
     * @var Collection
     */
    private $colleciton;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var array
     */
    private $loadedData = [];

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var QuickOrderInterface $block */
        foreach ($items as $quickorder) {
            $this->loadedData[$quickorder->getId()] = $quickorder->getData();
        }

        $data = $this->dataPersistor->get('quickorder');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear('quickorder');
        }

        return $this->loadedData;
    }
}
