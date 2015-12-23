<?php

namespace MinecraftMapEditor\Block;

class Fire extends Shared\BasicValue
{
    /**
     * Get FIRE! Set the age. If fire is given age 15 and is above a flammable
     * block, it'll never stop burning.
     *
     * @param int $age Age of the fire (0-15)
     */
    public function __construct($age = 0)
    {
        parent::__construct(Ref::FIRE, $age, 0, 15, 'Invalid age for fire');
    }
}
