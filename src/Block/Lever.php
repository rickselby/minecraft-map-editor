<?php

namespace MME\Block;

class Lever extends \MME\Block implements Interfaces\ActiveBit8
{
    use Traits\Create;

    const ATTACH_TOP_EAST = 0;
    const ATTACH_WEST = 1;
    const ATTACH_EAST = 2;
    const ATTACH_NORTH = 3;
    const ATTACH_SOUTH = 4;
    const ATTACH_BOTTOM_SOUTH = 5;
    const ATTACH_BOTTOM_EAST = 6;
    const ATTACH_TOP_SOUTH = 7;

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

        $this->checkDataRefValidStartsWith($orientation, 'ATTACH_', 'Invalid orientation for lever');
        $this->checkInList($active, [self::INACTIVE, self::ACTIVE], 'Invalid active status for lever');

        $this->setBlockData($orientation | $active);
    }
}
