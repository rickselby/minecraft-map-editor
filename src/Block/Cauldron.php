<?php

namespace MinecraftMapEditor\Block;

class Cauldron extends \MinecraftMapEditor\Block
{
    const FILL_EMPTY = 0x0;
    const FILL_THIRD = 0x1;
    const FILL_TWO_THIRDS = 0x2;
    const FILL_FULL = 0x3;

    /**
     * Get a cauldron with the given fill level.
     *
     * @param int $fill Fill level; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($fill)
    {
        $block = IDs::$list[Ref::CAULDRON];

        $this->checkDataRefValidAll($fill, 'Invalid fill level for Cauldron');

        parent::__construct($block[0], $fill);
    }
}
