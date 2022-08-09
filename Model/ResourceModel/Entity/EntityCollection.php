<?php
/*
  * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtEntity\Model\ResourceModel\Entity;

use GhostUnicorns\CrtEntity\Model\EntityModel;
use GhostUnicorns\CrtEntity\Model\ResourceModel\EntityResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class EntityCollection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'crt_entity_collection';
    protected $_eventObject = 'entity_collection';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(EntityModel::class, EntityResourceModel::class);
    }
}
