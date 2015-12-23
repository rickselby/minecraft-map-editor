<?php

namespace MinecraftMapEditor\Block;

class Pumpkin extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const SOUTH = 0;
    const WEST = 1;
    const NORTH = 2;
    const EAST = 3;
    const NO_FACE = 4;

    /**
     * Get a pumpkin or a jack o' lantern, facing the given direction
     * (or with no face at all).
     *
     * @param int $blockRef  Which pumpkin
     * @param int $direction One of the class constants
     */
    public function __construct($blockRef, $direction)
    {
        $block = $this->checkBlock($blockRef, [Ref::PUMPKIN, Ref::JACK_O_LANTERN]);

        $this->checkDataRefValidAll($direction, 'Invalid direction for pumpkin');

        parent::__construct($block[0], $direction);
    }
}
