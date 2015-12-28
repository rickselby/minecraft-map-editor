<?php

namespace MinecraftMapEditor\Block;

class Chest extends \MinecraftMapEditor\Block
{
    use Traits\Create, Traits\EntityData;

    const NORTH = 2;
    const SOUTH = 3;
    const EAST = 4;
    const WEST = 5;

    /**
     * Get a chest, facing in the given direction.
     *
     * @param int                         $blockRef   Chest block reference
     * @param int                         $direction  Direction the chest is facing; one of the class constants
     * @param \MinecraftMapEditor\Stack[] $items      Items in the chest, with pre-set slots (0-26)
     *                                                0 is the top-left corner
     * @param string                      $customName Custom name for the chest, appears in GUI
     * @param string                      $lock       Lock the beacon so it can only be opened if the player
     *                                                is holding an item whose name matches this string
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $direction, $items = [], $customName = null, $lock = null)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('CHEST'));

        $this->checkDataRefValidAll($direction, 'Invalid direction for chest');

        $this->setBlockData($direction);

        if ($blockRef == Ref::CHEST_ENDER) {

            $this->initEntityData('EnderChest');
            // No more data for Ender Chests.

        } else {

            $this->initEntityData('Chest');

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

            $this->setCustomName($customName);
            $this->setLock($lock);
        }
    }
}
