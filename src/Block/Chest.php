<?php

namespace MME\Block;

class Chest extends \MME\Block implements Interfaces\FacingSouth3
{
    use Traits\Create, Traits\EntityData;

    /**
     * Get a chest, facing in the given direction.
     *
     * @param int                         $blockRef   Chest block reference
     * @param int                         $direction  Direction the chest is facing; one of the class constants
     * @param \MME\Stack[] $items      Items in the chest, with pre-set slots (0-26).
     *                                                0 is the top-left corner.
     * @param string                      $customName Custom name for the chest, appears in GUI
     * @param string                      $lock       Lock the chest so it can only be opened if the player
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
            $this->addItemStacks($items);
            $this->setCustomName($customName);
            $this->setLock($lock);
        }
    }
}
