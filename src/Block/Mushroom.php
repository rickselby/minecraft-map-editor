<?php

namespace MinecraftMapEditor\Block;

class Mushroom extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const ALL_PORES = 0;
    const CAP_TOP_WEST_NORTH = 1;
    const CAP_TOP_NORTH = 2;
    const CAP_TOP_NORTH_EAST = 3;
    const CAP_TOP_WEST = 4;
    const CAP_TOP = 5;
    const CAP_TOP_EAST = 6;
    const CAP_TOP_SOUTH_WEST = 7;
    const CAP_TOP_SOUTH = 8;
    const CAP_TOP_EAST_SOUTH = 9;
    const STEM_SIDES = 10;
    const ALL_CAP = 14;
    const ALL_STEM = 15;

    /**
     * Get a mushroom block of the given type with the given texture layout.
     *
     * @param int $blockRef One of the MUSHROOM_BLOCKs
     * @param int $texture  One of the class constants
     */
    public function __construct($blockRef, $texture)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('MUSHROOM_BLOCK_'));

        $this->checkDataRefValidAll($texture, 'Invalid texture setting for mushroom block');

        $this->setBlockData($texture);
    }
}
