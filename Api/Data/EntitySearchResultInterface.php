<?php
/*
  * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtEntity\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface EntitySearchResultInterface extends SearchResultsInterface
{
    /**
     * @return EntityInterface[]
     */
    public function getItems();

    /**
     * @param EntityInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
