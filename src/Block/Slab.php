<?php

namespace MinecraftMapEditor\Block;

class Slab extends \MinecraftMapEditor\Block
{
    const BOTTOM = 0x0;
    const TOP = 0x8;

    /**
     * Get a slab, positioned either top or bottom of the block.
     *
     * @param int $blockRef Block reference from Block\Ref
     * @param int $position Position of slab; one of the class constants
     *
     * @throws Exception
     */
    public function __construct($blockRef, $position)
    {
        $block = self::checkBlock($blockRef, Ref::getStartsWith('SLAB_'));

        // Check the orientation is valid
        self::checkDataRefValidAll($position, 'Invalid position for slab');

        parent::__construct($block[0], $block[1] | position);
    }
}
