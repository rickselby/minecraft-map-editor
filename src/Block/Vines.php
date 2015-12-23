<?php

namespace MinecraftMapEditor\Block;

class Vines extends \MinecraftMapEditor\Block
{
    const SOUTH = 0b0001;
    const WEST  = 0b0010;
    const NORTH = 0b0100;
    const EAST  = 0b1000;

    /**
     * Get vines. If vines are on multiple sides, use the | operator
     * e.g. (Vines::SOUTH | Vines::EAST).
     *
     * @param int $sides Mix of the class constants
     *
     * @throws \Exception
     */
    public function __construct($sides)
    {
        // Hmm. Vines can be on multiple sides. It'd be nice to check against
        // constants, but we know the following:
        if ($sides < 1 || $sides > 15) {
            throw new \Exception('Invalid sides for vines');
        }

        $block = IDs::$list[Ref::VINES];

        parent::__construct($block[0], $sides);
    }
}
