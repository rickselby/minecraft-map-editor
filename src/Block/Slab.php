<?php

namespace MME\Block;

class Slab extends \MME\Block
{
    use Traits\Create;

    const BOTTOM = 0;
    const TOP = 8;

    /**
     * Get a slab, positioned either top or bottom of the block.
     *
     * @param int $blockRef Block reference from Block\Ref
     * @param int $position Position of slab; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $position)
    {
        $block = $this->checkBlock($blockRef, Ref::getStartsWith('SLAB_'));

        // Check the orientation is valid
        $this->checkDataRefValidAll($position, 'Invalid position for slab');

        $this->setBlockData($block[1] | $position);
    }
}
