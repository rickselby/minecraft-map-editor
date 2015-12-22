<?php

namespace MinecraftMapEditor\Block;

class Cake extends \MinecraftMapEditor\Block
{
    /**
     * Get a cake, with the given number of slices eaten.
     *
     * @param int $slicesEaten 0-6
     *
     * @throws \Exception
     */
    public function __construct($slicesEaten)
    {
        if ($slicesEaten < 0 || $slicesEaten > 6) {
            throw new \Exception('Invalid slices eaten for cake');
        }

        $block = IDs::$list[Ref::CAKE];

        parent::__construct($block[0], $slicesEaten);
    }
}
