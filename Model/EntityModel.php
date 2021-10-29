<?php
/*
  * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtEntity\Model;

use DateTime;
use Exception;
use GhostUnicorns\CrtEntity\Api\Data\EntityInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\Serialize\Serializer\Json;

class EntityModel extends AbstractExtensibleModel implements EntityInterface
{
    const ID = 'entity_id';
    const TYPE = 'type';
    const ACTIVITY_ID = 'activity_id';
    const IDENTIFIER = 'identifier';
    const DATA_ORIGINAL = 'data_original';
    const DATA_REFINED = 'data_refined';
    const EXTRA = 'extra';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const CACHE_TAG = 'crt_entity';
    protected $_cacheTag = 'crt_entity';
    protected $_eventPrefix = 'crt_entity';

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int
     */
    public function getActivityId(): int
    {
        return (int)$this->getData(self::ACTIVITY_ID);
    }

    /**
     * @param int $activityId
     * @return void
     */
    public function setActivityId(int $activityId)
    {
        $this->setData(self::ACTIVITY_ID, $activityId);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return (string)$this->getData(self::TYPE);
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->setData(self::TYPE, $type);
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return (string)$this->getData(self::IDENTIFIER);
    }

    /**
     * @param $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->setData(self::IDENTIFIER, $identifier);
    }

    /**
     * @return string
     */
    public function getDataOriginal(): string
    {
        return (string)$this->getData(self::DATA_ORIGINAL);
    }

    /**
     * @param $value
     */
    public function setDataOriginal($value)
    {
        $this->setData(self::DATA_ORIGINAL, $value);
    }

    /**
     * @return string
     */
    public function getDataRefined(): string
    {
        return (string)($this->getData(self::DATA_REFINED) ?? $this->getData(self::DATA_ORIGINAL));
    }

    /**
     * @param $value
     */
    public function setDataRefined($value)
    {
        $this->setData(self::DATA_REFINED, $value);
    }

    /**
     * @param array $value
     */
    public function addExtraArray(array $value)
    {
        $newValue = new DataObject($this->getExtra()->getData());
        $newValue->addData($value);
        $this->setData(self::EXTRA, $newValue->toJson());
    }

    /**
     * @return DataObject
     */
    public function getExtra(): DataObject
    {
        $serializer = new Json();
        $data = $this->getData(self::EXTRA) ? $serializer->unserialize($this->getData(self::EXTRA)) : [];
        return new DataObject($data);
    }

    /**
     * @param DataObject $value
     */
    public function setExtra(DataObject $value)
    {
        $this->setData(self::EXTRA, $value->toJson());
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->getData(self::CREATED_AT));
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getUpdatedAt(): DateTime
    {
        return new DateTime($this->getData(self::UPDATED_AT));
    }

    /**
     * @return bool
     */
    public function isSkip(): bool
    {
        return (bool)$this->getExtra()->getData('skip');
    }

    /**
     * @return void
     */
    public function skip()
    {
        $this->setExtra($this->getExtra()->setData('skip', true));
    }

    protected function _construct()
    {
        $this->_init(ResourceModel\EntityResourceModel::class);
    }
}
