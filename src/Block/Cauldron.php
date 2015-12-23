<?php

namespace MinecraftMapEditor\Block;

class Cauldron extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const FILL_EMPTY = 0;
    const FILL_THIRD = 1;
    const FILL_TWO_THIRDS = 2;
    const FILL_FULL = 3;

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
