<?php

namespace MinecraftMapEditor\Block;

class Rail extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const ORIENT_SOUTH_EAST = 6;
    const ORIENT_SOUTH_WEST = 7;
    const ORIENT_NORTH_WEST = 8;
    const ORIENT_NORTH_EAST = 9;

    /**
     * Get a normal rail, with the given orientation.
     * Slopes ascend to the given direction.
     *
     * @param int $orientation One of the class constants
     *
     * @throws \Exception
     */
    public function __construct($orientation)
    {
        $this->setBlockIDFor(Ref::RAIL);

        $this->checkDataRefValidAll($orientation, 'Invalid orientation for rail');

        $this->setBlockData($orientation);
    }
}
