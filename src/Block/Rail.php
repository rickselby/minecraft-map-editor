<?php

namespace MinecraftMapEditor\Block;

class Rail extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const NORTH_SOUTH = 0;
    const EAST_WEST = 1;
    const SLOPED_EAST = 2;
    const SLOPED_WEST = 3;
    const SLOPED_NORTH = 4;
    const SLOPED_SOUTH = 5;
    const SOUTH_EAST = 6;
    const SOUTH_WEST = 7;
    const NORTH_WEST = 8;
    const NORTH_EAST = 9;

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
