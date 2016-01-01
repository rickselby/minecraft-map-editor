<?php

namespace MME\Block;

class Dropper extends \MME\Block
    implements Interfaces\OutputFull, Interfaces\ActiveBit8
{
    use Traits\Create, Traits\EntityData;

    /**
     * Get a droppper OR a dispenser (sorry) with the given direction.
     *
     * @param int                         $blockRef   BlockRef for dropper or dispenser
     * @param int                         $direction  Direction the block is facing; one of the OUTPUT_ class consants
     * @param \MME\Stack[] $items      Items in the dropper, with pre-set slots (0-8).
     *                                                0 is the top-left corner.
     * @param int                         $activated  [Optional] Either Dropper:INACTIVE or Dropper::ACTIVE
     * @param string                      $customName Custom name for the chest, appears in GUI
     * @param string                      $lock       Lock the dropper so it can only be opened if the player
     *                                                is holding an item whose name matches this string
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $direction, $items = [], $activated = self::INACTIVE, $customName = null, $lock = null)
    {
        $this->checkBlock($blockRef, [
            Ref::DISPENSER,
            Ref::DROPPER,
        ]);

        $this->checkDataRefValidStartsWith($direction, 'OUTPUT_', 'Invalid direction for Dropper/Dispenser');
        $this->checkInList($activated, [self::INACTIVE, self::ACTIVE], 'Invalid active setting for Dropper/Dispenser');

        $this->setBlockData($direction | $activated);

        switch($blockRef) {
            case Ref::DISPENSER:
                $entityDataName = 'Trap';
                break;
            case Ref::DROPPER:
                $entityDataName = 'Dropper';
                break;
        }
        $this->initEntityData($entityDataName);
        $this->addItemStacks($items);
        $this->setCustomName($customName);
        $this->setLock($lock);
    }
}
