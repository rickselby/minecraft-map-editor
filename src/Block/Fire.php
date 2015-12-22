<?php

namespace MinecraftMapEditor\Block;

class Fire extends \MinecraftMapEditor\Block
{
    /**
     * Get FIRE! Set the age. If fire is given age 15 and is above a flammable
     * block, it'll never stop burning.
     *
     * @param int $age Age of the fire (0-15)
     */
    public function __construct($age = 0)
    {
        if ($age < 0 || $age > 15) {
            throw new \Exception('Invalid age for fire');
        }

        $block = IDs::$list[Ref::FIRE];

        parent::__construct($block[0], $age);
    }
}
