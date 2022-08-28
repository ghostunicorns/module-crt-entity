<?php
/*
  * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtEntity\Model\Config\Source;

use GhostUnicorns\CrtBase\Api\CrtListInterface;
use Magento\Framework\Data\OptionSourceInterface;

class Types implements OptionSourceInterface
{
    /**
     * @var CrtListInterface
     */
    private $crtList;

    /**
     * @param CrtListInterface $crtList
     */
    public function __construct(
        CrtListInterface $crtList
    ) {
        $this->crtList = $crtList;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        $options = [];

        $allCollectors = $this->crtList->getAllCollectorList();
        foreach ($allCollectors as $allCollector) {
            $types = array_keys($allCollector);

            foreach ($types as $type) {
                $options[] = [
                    'value' => $type,
                    'label' => 'Downlaoder: ' . $type
                ];
            }
        }

        $allRefiners = $this->crtList->getAllRefinerList();
        foreach ($allRefiners as $allRefiner) {
            $types = array_keys($allRefiner);

            foreach ($types as $type) {
                $options[] = [
                    'value' => $type,
                    'label' => 'Refiner: ' . $type
                ];
            }
        }

        $allTransferors = $this->crtList->getAllTransferorList();
        foreach ($allTransferors as $allTransferor) {
            $types = array_keys($allTransferor);

            foreach ($types as $type) {
                $options[] = [
                    'value' => $type,
                    'label' => 'Transferor: ' . $type
                ];
            }
        }

        return $options;
    }
}
