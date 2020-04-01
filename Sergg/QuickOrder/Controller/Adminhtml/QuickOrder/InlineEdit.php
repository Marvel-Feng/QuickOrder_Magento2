<?php


namespace Sergg\QuickOrder\Controller\Adminhtml\QuickOrder;

use Sergg\QuickOrder\Api\Model\QuickOrderInterfaceFactory;
use Sergg\QuickOrder\Api\Repository\QuickOrderRepositoryInterface;
use Sergg\QuickOrder\Model\QuickOrder;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

/**
 * Class InlineEdit
 * @package Sergg\QuickOrder\Controller\Adminhtml\QuickOrder
 */
class InlineEdit extends Action
{
    /** @var QuickOrderRepositoryInterface */
    private $repository;

    /** @var QuickOrderInterfaceFactory */
    private $modelFactory;

    /** @var DataPersistorInterface */
    private $dataPersistor;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        Context $context,
        QuickOrderRepositoryInterface $repository,
        QuickOrderInterfaceFactory $quickorderFactory,
        DataPersistorInterface $dataPersistor,
        LoggerInterface $logger
    )
    {
        $this->repository = $repository;
        $this->modelFactory = $quickorderFactory;
        $this->dataPersistor = $dataPersistor;
        $this->logger = $logger;

        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            /** @var QuickOrder $model */
            $model = $this->modelFactory->create();

            $id = $this->getRequest()->getParam('order_id');

                    $model = $this->repository->getById($id);
                // Foreach Vstavite :)

            $model->setData($data);

            try {
                $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the order.'));
                $this->dataPersistor->clear('quickorder');
                return $resultRedirect->setPath('*/*/listing');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the user.'));
            }

            $this->dataPersistor->set('quickorder', $data);
            return $resultRedirect->setPath('*/*/edit', ['order_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/listing');
    }
}
