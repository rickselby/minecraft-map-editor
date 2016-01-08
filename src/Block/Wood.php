<?php

namespace MME\Block;

class Wood extends \MME\Block
{
    use Traits\Create;

    const UP_DOWN = 0b0000;
    const EAST_WEST = 0b0100;
    const NORTH_SOUTH = 0b1000;
    const BARK_ONLY = 0b1100;

    /**
     * Get a block of wood, with the given orientation.
     *
     * @param int $blockRef    Block reference from Block\Ref
     * @param int $orientation Orientation of the wood; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $orientation)
    {
        $block = $this->checkBlock($blockRef, [
            Ref::WOOD_ACACIA,
            Ref::WOOD_BIRCH,
            Ref::WOOD_DARK_OAK,
            Ref::WOOD_JUNGLE,
            Ref::WOOD_OAK,
            Ref::WOOD_SPRUCE,
        ]);

        // Check the orientation is valid
        $this->checkDataRefValidAll($orientation, 'Invalid orientation for wood');

        $this->setBlockData($block[1] | $orientation);
    }
}
