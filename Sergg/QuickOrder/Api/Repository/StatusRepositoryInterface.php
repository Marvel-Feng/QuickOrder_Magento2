<?php

namespace Sergg\QuickOrder\Api\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Sergg\QuickOrder\Api\Model\Data\StatusInterface;

interface StatusRepositoryInterface
{
    /**
     * @param int $id
     * @return StatusInterface
     */
    public function getById(int $id) : StatusInterface;

    /**
     * @return SearchResultsInterface
     */

    public function getList() : SearchResultsInterface;

    /**
     * @param StatusInterface $status
     * @return StatusInterface
     */
    public function save(StatusInterface $status) : StatusInterface;

    /**
     * @param StatusInterface $status
     * @return StatusRepositoryInterface
     */
    public function delete(StatusInterface $status) : StatusRepositoryInterface;

    /**
     * @param int $id
     * @return StatusRepositoryInterface
     */
    public function deleteById(int $id) : StatusRepositoryInterface;
}
