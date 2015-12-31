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
     * Set a custom name if it isn't null.
     *
     * @param string|null $customName
     */
    protected function setCustomName($customName)
    {
        $this->addChildIfNotNull('CustomName', \Nbt\Tag::TAG_STRING, $customName);
    }

    /**
     * Set the name of the lock item, if not null.
     *
     * @param string|null $lock
     */
    protected function setLock($lock)
    {
        $this->addChildIfNotNull('Lock', \Nbt\Tag::TAG_STRING, $lock);
    }

    /**
     * Add a child to the entity if the value is not null.
     *
     * @param string $name
     * @param int    $type
     * @param mixed  $value
     */
    protected function addChildIfNotNull($name, $type, $value)
    {
        if ($value !== null) {
            $this->entityData->addChild(
                (new \Nbt\Node())->setType($type)->setName($name)->setValue($value)
            );
        }
    }

    /**
     * Add a list of item stacks to the 'Items' list tag.
     *
     * @param \MinecraftMapEditor\Stack[] $items
     */
    protected function addItemStacks($items)
    {
        if (count($items)) {
            $payload = \Nbt\Tag::TAG_COMPOUND;
        } else {
            $payload = \Nbt\Tag::TAG_END;
        }
        $itemsList = \Nbt\Tag::tagList('Items', $payload, []);
        $this->entityData->addChild($itemsList);

        foreach ($items as $item) {
            $itemsList->addChild($item->node);
        }
    }

    /**
     * Add slots to a list of items, keyed by their slot numbers.
     *
     * @param mixed[] $items Array of items, either Stacks or nulls
     *
     * @return mixed[]
     */
    protected function addItemsForSlots($items)
    {
        // Process each item for the given slot
        $itemList = [];
        foreach ($items as $slot => $item) {
            if ($item) {
                $this->updateChildOrCreate($item->node, 'Slot', \Nbt\Tag::TAG_INT, $slot);
                $itemList[] = $item;
            }
        }

        $this->addItemStacks($itemList);
    }
}
