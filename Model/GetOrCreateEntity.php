<?php
/*
  * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtEntity\Model;

use Exception;
use GhostUnicorns\CrtEntity\Api\Data\EntityInterface;
use GhostUnicorns\CrtEntity\Api\EntityRepositoryInterface;
use GhostUnicorns\CrtEntity\Model\EntityModelFactory;

class GetOrCreateEntity
{
    /**
     * @var EntityRepositoryInterface
     */
    private $entityRepository;

    /**
     * @var EntityModelFactory
     */
    private $entityModelFactory;

    /**
     * @param EntityRepositoryInterface $entityRepository
     * @param EntityModelFactory $entityModelFactory
     */
    public function __construct(
        EntityRepositoryInterface $entityRepository,
        EntityModelFactory $entityModelFactory
    ) {
        $this->entityRepository = $entityRepository;
        $this->entityModelFactory = $entityModelFactory;
    }

    /**
     * @param int $activityId
     * @param string $identifier
     * @param string $collectorType
     * @return EntityInterface
     * @throws Exception
     */
    public function execute(int $activityId, string $identifier, string $collectorType): EntityInterface
    {
        $entity = $this->entityRepository->getByActivityIdAndIdentifierAndType(
            $activityId,
            $identifier,
            $collectorType
        );

        if ($entity->getId()) {
            return $entity;
        }

        $entity = $this->entityModelFactory->create();
        $entity->setActivityId($activityId);
        $entity->setType($collectorType);
        $entity->setIdentifier($identifier);
        return $entity;
    }
}
