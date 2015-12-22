<?php

namespace MinecraftMapEditor\Block;

class Pumpkin extends \MinecraftMapEditor\Block
{
    const SOUTH = 0x0;
    const WEST = 0x1;
    const NORTH = 0x2;
    const EAST = 0x3;
    const NO_FACE = 0x4;

    /**
     * Get a pumpkin or a jack o' lantern, facing the given direction
     * (or with no face at all).
     *
     * @param int $blockRef  Which pumpkin
     * @param int $direction One of the class constants
     */
    public function __construct($blockRef, $direction)
    {
        $block = self::checkBlock($blockRef, [Ref::PUMPKIN, Ref::JACK_O_LANTERN]);

        self::checkDataRefValidAll($direction, 'Invalid direction for pumpkin');

        parent::__construct($block[0], $direction);
    }
}
