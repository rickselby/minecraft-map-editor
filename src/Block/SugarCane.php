<?php

namespace MinecraftMapEditor\Block;

class SugarCane extends Shared\BasicValue
{
    /**
     * Get a sugar cane with a given age. When the age is 15, it'll grow a new
     * sugar cane block on top of it (if the total height doesn't exceed 3).
     *
     * @param int $age Age of the sugar cane
     *
     * @throws \Exception
     */
    public function __construct($age)
    {
        parent::__construct(Ref::SUGAR_CANE, $age, 0, 15, 'Invalid age for sugar cane');
    }
}
