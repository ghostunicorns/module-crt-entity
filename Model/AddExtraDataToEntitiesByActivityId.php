<?php
/*
  * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtEntity\Model;

use Exception;
use GhostUnicorns\CrtEntity\Api\EntityRepositoryInterface;

class AddExtraDataToEntitiesByActivityId
{
    /**
     * @var EntityRepositoryInterface
     */
    private $entityRepository;

    /**
     * @param EntityRepositoryInterface $entityRepository
     */
    public function __construct(
        EntityRepositoryInterface $entityRepository
    ) {
        $this->entityRepository = $entityRepository;
    }

    /**
     * @param int $activityId
     * @param string $identifier
     * @param array $extraData
     * @throws Exception
     */
    public function execute(int $activityId, string $identifier, array $extraData)
    {
        $entities = $this->entityRepository->getAllByActivityIdAndIdentifier($activityId, $identifier);

        foreach ($entities as $entity) {
            $entity->addExtraArray($extraData);
            $this->entityRepository->save($entity);
        }
    }
}
