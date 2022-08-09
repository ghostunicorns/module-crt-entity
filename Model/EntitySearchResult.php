<?php
/*
  * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtEntity\Model;

use GhostUnicorns\CrtEntity\Api\Data\EntitySearchResultInterface;
use Magento\Framework\Api\Search\SearchResult;

class EntitySearchResult extends SearchResult implements EntitySearchResultInterface
{

}
