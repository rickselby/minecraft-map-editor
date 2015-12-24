<?php

namespace MinecraftMapEditor\Block;

class Bed extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const DIRECTION_SOUTH = 0;
    const DIRECTION_WEST = 1;
    const DIRECTION_NORTH = 2;
    const DIRECTION_EAST = 3;

    const PART_FOOT = 0b0000;
    const PART_HEAD = 0b1000;

    /**
     * Get half a bed, given the direction (head facing) and which part.
     *
     * @param int $direction The direction the head of the bed is facing; one of the DIRECTION_ class constants
     * @param int $part      The part of the bed; one of the PART_ class constants
     *
     * @throws \Exception
     */
    public function __construct($direction, $part)
    {
        $this->setBlockIDFor(Ref::BED);

        $this->checkDataRefValidStartsWith($direction, 'DIRECTION_', 'Invalid direction for bed');
        $this->checkDataRefValidStartsWith($part, 'PART_', 'Invalid part for bed');

        $this->setBlockData($direction | $part);
    }
}
