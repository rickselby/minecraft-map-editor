<?php

namespace MinecraftMapEditor\Block;

class Ladder extends \MinecraftMapEditor\Block
{
    const NORTH = 0x2;
    const SOUTH = 0x3;
    const WEST = 0x4;
    const EAST = 0x5;

    /**
     * Get a ladder, facing the given direction.
     *
     * @param int $facing One of the class constants
     *
     * @throws \Exception
     */
    public function __construct($facing)
    {
        $block = IDs::$list[Ref::LADDER];

        self::checkDataRefValidAll($facing, 'Invalid facing value for ladder');

        parent::__construct($block[0], $facing);
    }
}
