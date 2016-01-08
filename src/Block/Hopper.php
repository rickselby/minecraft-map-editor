<?php

namespace MME\Block;

class Hopper extends \MME\Block implements Interfaces\Output
{
    use Traits\Create, Traits\EntityData;

    const ACTIVE = 0b0000;
    const DISABLED = 0b1000;

    /**
     * Get a hopper, with the output in the given direction.
     *
     * @param int                         $output           Output direction; one of the OUTPUT_ class constants
     * @param \MME\Stack[] $items            Items in the dropper, with pre-set slots (0-8).
     *                                                      0 is the top-left corner.
     * @param int                         $active           [Optional] Either Hopper:INACTIVE or Hopper::ACTIVE
     * @param string                      $customName       Custom name for the chest, appears in GUI
     * @param string                      $lock             Lock the dropper so it can only be opened if the player
     *                                                      is holding an item whose name matches this string
     * @param int                         $transferCooldown Time to next transfer in game ticks.
     *
     * @throws \Exception
     */
    public function __construct($output, $items = [], $active = self::ACTIVE, $customName = null, $lock = null, $transferCooldown = 0)
    {
        $this->setBlockIDFor(Ref::HOPPER);

        $this->checkDataRefValidStartsWith($output, 'OUTPUT_', 'Invalid output reference for hopper');
        $this->checkInList($active, [self::ACTIVE, self::DISABLED], 'Invalid active reference for hopper');

        $this->setBlockData($output | $active);

        $this->initEntityData('Hopper');
        $this->addItemStacks($items);
        $this->setCustomName($customName);
        $this->setLock($lock);
        $this->entityData->addChild(\Nbt\Tag::tagInt('TransferCooldown', $transferCooldown));
    }
}
