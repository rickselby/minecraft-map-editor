<?php

namespace MinecraftMapEditor\Block;

class Dropper extends \MinecraftMapEditor\Block
{
    const DIRECTION_DOWN = 0x0;
    const DIRECTION_UP = 0x1;
    const DIRECTION_NORTH = 0x2;
    const DIRECTION_SOUTH = 0x3;
    const DIRECTION_WEST = 0x4;
    const DIRECTION_EAST = 0x5;

    const INACTIVE = 0b0000;
    const ACTIVE   = 0b1000;

    /**
     * Get a droppper OR a dispenser (sorry) with the given direction.
     *
     * @param int  $blockRef  BlockRef for dropper or dispenser
     * @param int  $direction Direction the block is facing; one of the class consants
     * @param int $activated [Optional] Either Dropper:INACTIVE or Dropper::ACTIVE
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $direction, $activated = self::INACTIVE)
    {
        $block = self::checkBlock($blockRef, [
            Ref::DISPENSER,
            Ref::DROPPER,
        ]);

        self::checkDataRefValidStartWith($direction, 'DIRECTION_', 'Invalid direction for Dropper/Dispenser');
        self::checkInList($activated, [self::INACTIVE, self::ACTIVE], 'Invalid active setting for Dropper/Dispenser');


        parent::__construct($block[0], $direction | $activated);
    }
}
