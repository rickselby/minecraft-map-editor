<?php

namespace MinecraftMapEditor\Block;

class Cake extends \MinecraftMapEditor\Block\Shared\BasicValue
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
        parent::__construct(Ref::CAKE, $slicesEaten, 0, 6, 'Invalid slices eaten for cake');
    }
}
