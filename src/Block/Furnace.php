<?php

namespace MME\Block;

class Furnace extends \MME\Block implements Interfaces\FacingSouth3
{
    use Traits\Create, Traits\EntityData;

    /**
     * Get a furnace facing in the given direction.
     *
     * @param int $blockRef Which furnace to use
     * @param int $facing   The direction it faces; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $facing,
        $input = null, $fuel = null, $output = null,
        $burnTime = 0, $cookTime = 0, $cookTimeTotal = 0)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('FURNACE'));

        $this->checkDataRefValidAll($facing, 'Invalid facing reference for furnace');

        $this->setBlockData($facing);

        $this->initEntityData('Furnace');

        $this->addItemsForSlots([
            0 => $input,
            1 => $fuel,
            2 => $output,
        ]);

        $this->entityData->addChild(\Nbt\Tag::tagShort('BurnTime', $burnTime));
        $this->entityData->addChild(\Nbt\Tag::tagShort('CookTime', $cookTime));
        $this->entityData->addChild(\Nbt\Tag::tagShort('CookTimeTotal', $cookTimeTotal));
    }
}
