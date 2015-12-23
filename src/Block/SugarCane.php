<?php

namespace MinecraftMapEditor\Block;

class SugarCane extends \MinecraftMapEditor\Block
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
        if ($age < 0 || $age > 15) {
            throw new \Exception('Invalid age for sugar cane');
        }

        $block = IDs::$list[Ref::SUGAR_CANE];

        parent::__construct($block[0], $age);
    }
}
