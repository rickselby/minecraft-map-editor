<?php

namespace MinecraftMapEditor\Block;

class Chest extends \MinecraftMapEditor\Block
{
    const NORTH = 0x2;
    const SOUTH = 0x3;
    const EAST  = 0x4;
    const WEST  = 0x5;

    /**
     * Get a chest, facing in the given direction.
     *
     * @param int $blockRef  Chest block reference
     * @param int $direction Direction the chest is facing; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $direction)
    {
        $block = self::checkBlock($blockRef, Ref::getStartsWith('CHEST'));

        self::checkDataRefValidAll($direction, 'Invalid direction for chest');

        parent::__construct($block[0], $direction);
    }
}
