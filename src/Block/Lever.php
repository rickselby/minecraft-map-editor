<?php

namespace MinecraftMapEditor\Block;

class Lever extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const SIDE_BOTTOM_EAST = 0;
    const SIDE_EAST = 1;
    const SIDE_WEST = 2;
    const SIDE_SOUTH = 3;
    const SIDE_NORTH = 4;
    const SIDE_TOP_SOUTH = 5;
    const SIDE_TOP_EAST = 6;
    const SIDE_BOTTOM_SOUTH = 7;

    const INACTIVE = 0b0000;
    const ACTIVE = 0b1000;

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
        $this->setBlockIDFor(Ref::LEVER);

        $this->checkDataRefValidStartsWith($orientation, 'SIDE_', 'Invalid orientation for lever');
        $this->checkInList($active, [self::INACTIVE, self::ACTIVE], 'Invalid active status for lever');

        $this->setBlockData($orientation | $active);
    }
}
