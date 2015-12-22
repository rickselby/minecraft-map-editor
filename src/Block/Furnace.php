<?php

namespace MinecraftMapEditor\Block;

class Furnace extends \MinecraftMapEditor\Block
{
    const NORTH = 0x2;
    const SOUTH = 0x3;
    const WEST = 0x4;
    const EAST = 0x5;

    /**
     * Get a furnace facing in the given direction.
     *
     * @param int $blockRef Which furnace to use
     * @param int $facing   The direction it faces; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $facing)
    {
        $block = self::checkBlock($blockRef, Ref::getStartsWith('FURNACE'));

        self::checkDataRefValidAll($facing, 'Invalid facing reference for furnace');

        parent::__construct($block[0], $facing);
    }
}
