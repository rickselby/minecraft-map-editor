<?php

namespace MinecraftMapEditor\Block;

class Lever extends \MinecraftMapEditor\Block
{
    const SIDE_BOTTOM_EAST  = 0x0;
    const SIDE_EAST         = 0x1;
    const SIDE_WEST         = 0x2;
    const SIDE_SOUTH        = 0x3;
    const SIDE_NORTH        = 0x4;
    const SIDE_TOP_SOUTH    = 0x5;
    const SIDE_TOP_EAST     = 0x6;
    const SIDE_BOTTOM_SOUTH = 0x7;

    const INACTIVE = 0b0000;
    const ACTIVE   = 0b1000;

    /**
     * Get a lever, with the given orientation, active or not.
     * If the lever is on the top/bottom of a block, it can be set so off is
     * either east or south.
     *
     * @param int $orientation One of the class SIDE_ constants
     * @param int $active      Either Lever::INACTIVE or Lever::ACTIVE
     *
     * @throws \Exception
     */
    public function __construct($orientation, $active = self::INACTIVE)
    {
        $block = IDs::$list[Ref::LEVER];

        self::checkDataRefValidStartWith($orientation, 'SIDE_', 'Invalid orientation for lever');
        self::checkInList($active, [self::INACTIVE, self::ACTIVE], 'Invalid active status for lever');

        parent::__construct($block[0], $orientation | $active);
    }
}
