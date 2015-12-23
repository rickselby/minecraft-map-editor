<?php

namespace MinecraftMapEditor\Block;

class Bed extends \MinecraftMapEditor\Block
{
    const DIRECTION_SOUTH = 0x0;
    const DIRECTION_WEST  = 0x1;
    const DIRECTION_NORTH = 0x2;
    const DIRECTION_EAST  = 0x3;

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
        self::checkDataRefValidStartWith($direction, 'DIRECTION_', 'Invalid direction for bed');
        self::checkDataRefValidStartWith($part, 'PART_', 'Invalid part for bed');

        $block = IDs::$list[Ref::BED];

        parent::__construct($block[0], $direction | $part);
    }
}
