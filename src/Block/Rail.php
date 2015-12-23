<?php

namespace MinecraftMapEditor\Block;

class Rail extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const NORTH_SOUTH = 0x0;
    const EAST_WEST = 0x1;
    const SLOPED_EAST = 0x2;
    const SLOPED_WEST = 0x3;
    const SLOPED_NORTH = 0x4;
    const SLOPED_SOUTH = 0x5;
    const SOUTH_EAST = 0x6;
    const SOUTH_WEST = 0x7;
    const NORTH_WEST = 0x8;
    const NORTH_EAST = 0x9;

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
        $block = IDs::$list[Ref::RAIL];

        $this->checkDataRefValidAll($orientation, 'Invalid orientation for rail');

        parent::__construct($block[0], $orientation);
    }
}
