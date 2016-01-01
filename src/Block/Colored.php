<?php

namespace MME\Block;

class Colored extends MME\Block implements Interfaces\Colors
{
    use Traits\Create;

    /**
     * Get a colored block.
     *
     * @param int $blockRef One of the blocks that can be different colors
     * @param int $color    One of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $color)
    {
        $block = $this->checkBlock($blockRef, [
            Ref::WOOL,
            Ref::CARPET,
            Ref::CLAY_STAINED,
            Ref::GLASS_STAINED,
            Ref::GLASS_PANE_STAINED,
        ]);

        $this->checkDataRefValidAll($color, 'Invalid color for '.Ref::getNameFor($blockRef));

        $this->setBlockData($color);
    }
}
