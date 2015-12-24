<?php

namespace MinecraftMapEditor\Block;

class Fire extends \MinecraftMapEditor\Block
{
    use Traits\BasicValue, Traits\Create;

    /**
     * Get FIRE! Set the age. If fire is given age 15 and is above a flammable
     * block, it'll never stop burning.
     *
     * @param int $age Age of the fire (0-15)
     */
    public function __construct($age = 0)
    {
        $this->setBlockIDFor(Ref::FIRE);
        $this->checkValue($age, 0, 15, 'Invalid age for fire');
    }
}
