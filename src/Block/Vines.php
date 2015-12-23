<?php

namespace MinecraftMapEditor\Block;

class Vines extends \MinecraftMapEditor\Block\Shared\BasicValue
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
        parent::__construct(Ref::VINES, $sides, 1, 15, 'Invalid sides for vines');
    }
}
