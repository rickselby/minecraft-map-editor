<?php

namespace MinecraftMapEditor\Block;

class Farmland extends Shared\BasicValue
{
    /**
     * Get a farmland block, with the given wetness.
     *
     * @param int $wetness 0-7
     */
    public function __construct($wetness)
    {
        parent::__construct(Ref::FARMLAND, $wetness, 0, 7, 'Invalid wetness for farmland');
    }
}
