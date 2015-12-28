<?php

namespace MinecraftMapEditor\Block\Traits;

use Nbt\Tag;

trait EntityData
{
    use \MinecraftMapEditor\Nbt\Helpers;

    /**
     * Initialise entity data, if none passed in.
     *
     * @param string         $id         Tile Entity ID
     * @param \Nbt\Node|null $entityData
     */
    protected function initEntityData($id, $entityData = null)
    {
        if ($entityData === null
            || get_class($entityData) !== \Nbt\Node::class
            || $entityData->getType() !== \Nbt\Tag::TAG_COMPOUND) {
            $entityData = \Nbt\Tag::tagCompound('', []);
        }

        $this->updateChildOrCreate($entityData, 'id', Tag::TAG_STRING, $id);

        $this->setEntityData($entityData);
    }

    /**
     * Set a custom name if it isn't null
     * @param string|null $customName
     */
    protected function setCustomName($customName)
    {
        $this->addChildIfNotNull('CustomName', \Nbt\Tag::TAG_STRING, $customName);
    }

    /**
     * Set the name of the lock item, if not null
     * @param string|null $lock
     */
    protected function setLock($lock)
    {
        $this->addChildIfNotNull('Lock', \Nbt\Tag::TAG_STRING, $lock);
    }

    /**
     * Add a child to the entity if the value is not null
     *
     * @param string $name
     * @param int $type
     * @param mixed $value
     */
    protected function addChildIfNotNull($name, $type, $value)
    {
        if ($value !== null) {
            $this->entityData->addChild(
                (new \Nbt\Node())->setType($type)->setName($name)->setValue($value)
            );
        }
    }
}
