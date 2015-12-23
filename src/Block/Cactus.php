<?php

namespace MinecraftMapEditor\Block;

class Cactus extends Shared\BasicValue
{
    /**
     * Get a cactus with a given age. When the age is 15, it'll grow a new cactus
     * block on top of it (if the total height doesn't exceed 3).
     *
     * @param int $age Age of the cactus
     *
     * @throws \Exception
     */
    public function __construct($age)
    {
        parent::__construct(Ref::CACTUS, $age, 0, 15, 'Invalid age for cactus');
    }
}
