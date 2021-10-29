<?php
/*
 * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtEntity\Model;

use GhostUnicorns\CrtEntity\Api\EntityRepositoryInterface;
use GhostUnicorns\CrtEntity\Model\ResourceModel\EntityResourceModel;
use Magento\Framework\Exception\AlreadyExistsException;

class ClearDataRefinedByActivityId
{
    /**
     * @var EntityRepositoryInterface
     */
    private EntityRepositoryInterface $entityRepository;

    /**
     * @var EntityResourceModel
     */
    private $entityResourceModel;

    /**
     * @param EntityRepositoryInterface $entityRepository
     * @param EntityResourceModel $entityResourceModel
     */
    public function __construct(
        EntityRepositoryInterface $entityRepository,
        EntityResourceModel $entityResourceModel
    ) {
        $this->entityRepository = $entityRepository;
        $this->entityResourceModel = $entityResourceModel;
    }

    /**
     * @param int $activityId
     * @throws AlreadyExistsException
     */
    public function execute(int $activityId)
    {
        $entities = $this->entityRepository->getAllByActivityId($activityId);
        foreach ($entities as $entity) {
            $entity->setDataRefined(null);
            $this->entityResourceModel->save($entity);
        }
    }
}
