<?php

namespace MinecraftMapEditor\Block;

class Mushroom extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const ALL_PORES = 0x0;
    const CAP_TOP_WEST_NORTH = 0x1;
    const CAP_TOP_NORTH = 0x2;
    const CAP_TOP_NORTH_EAST = 0x3;
    const CAP_TOP_WEST = 0x4;
    const CAP_TOP = 0x5;
    const CAP_TOP_EAST = 0x6;
    const CAP_TOP_SOUTH_WEST = 0x7;
    const CAP_TOP_SOUTH = 0x8;
    const CAP_TOP_EAST_SOUTH = 0x9;
    const STEM_SIDES = 0x10;
    const ALL_CAP = 0x14;
    const ALL_STEM = 0x15;

    /**
     * Get a mushroom block of the given type with the given texture layout.
     *
     * @param int $blockRef One of the MUSHROOM_BLOCKs
     * @param int $texture  One of the class constants
     */
    public function __construct($blockRef, $texture)
    {
        $block = $this->checkBlock($blockRef, Ref::getStartsWith('MUSHROOM_BLOCK_'));

        $this->checkDataRefValidAll($texture, 'Invalid texture setting for mushroom block');

        parent::__construct($block[0], $texture);
    }
}
