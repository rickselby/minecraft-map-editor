<?php

namespace MinecraftMapEditor\Block;

class Dropper extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const DIRECTION_DOWN = 0;
    const DIRECTION_UP = 1;
    const DIRECTION_NORTH = 2;
    const DIRECTION_SOUTH = 3;
    const DIRECTION_WEST = 4;
    const DIRECTION_EAST = 5;

    const INACTIVE = 0b0000;
    const ACTIVE = 0b1000;

    /**
     * Get a droppper OR a dispenser (sorry) with the given direction.
     *
     * @param int $blockRef  BlockRef for dropper or dispenser
     * @param int $direction Direction the block is facing; one of the class consants
     * @param int $activated [Optional] Either Dropper:INACTIVE or Dropper::ACTIVE
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $direction, $activated = self::INACTIVE)
    {
        $this->checkBlock($blockRef, [
            Ref::DISPENSER,
            Ref::DROPPER,
        ]);

        $this->checkDataRefValidStartsWith($direction, 'DIRECTION_', 'Invalid direction for Dropper/Dispenser');
        $this->checkInList($activated, [self::INACTIVE, self::ACTIVE], 'Invalid active setting for Dropper/Dispenser');

        $this->setBlockData($direction | $activated);
    }
}
