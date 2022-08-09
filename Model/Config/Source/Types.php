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
            $downaloders = $allCollector->getCollectors();
            $types = array_keys($downaloders);

            foreach ($types as $type) {
                $options[] = [
                    'value' => $type,
                    'label' => 'Downlaoder: ' . $type
                ];
            }
        }

        $allRefiners = $this->crtList->getAllRefinerList();
        foreach ($allRefiners as $allRefiner) {
            $refiners = $allRefiner->getRefiners();
            $types = array_keys($refiners);

            foreach ($types as $type) {
                $options[] = [
                    'value' => $type,
                    'label' => 'Refiner: ' . $type
                ];
            }
        }

        $allTransferors = $this->crtList->getAllTransferorList();
        foreach ($allTransferors as $allTransferor) {
            $transferors = $allTransferor->getTransferors();
            $types = array_keys($transferors);

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
