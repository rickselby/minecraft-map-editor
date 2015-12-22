<?php

namespace MinecraftMapEditor\Block;

class Cactus extends \MinecraftMapEditor\Block
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
        if ($age < 0 || $age > 15) {
            throw new \Exception('Invalid age for cactus');
        }

        $block = IDs::$list[Ref::CACTUS];

        parent::__construct($block[0], $age);
    }
}
