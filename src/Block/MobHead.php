<?php

namespace MinecraftMapEditor\Block;

class MobHead extends \MinecraftMapEditor\Block
{
    const FLOOR = 0x1;
    const WALL_NORTH = 0x2;
    const WALL_SOUTH = 0x3;
    const WALL_EAST = 0x4;
    const WALL_WEST = 0x5;

    /**
     * Get a mob head, with the given placement.
     * (Which head it is will be in tile entity, to be implemented).
     * 
     * @param int $placement One of the class constants
     *
     * @throws \Exception
     */
    public function __construct($placement)
    {
        $block = IDs::$list[Ref::MOB_HEAD];

        self::checkDataRefValidAll($placement, 'Invalid placement for mob head');

        parent::__construct($block[0], $placement);
    }
}
