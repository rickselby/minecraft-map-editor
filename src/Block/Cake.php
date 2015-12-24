<?php

namespace MinecraftMapEditor\Block;

class Cake extends \MinecraftMapEditor\Block
{
    use Traits\BasicValue, Traits\Create;

    /**
     * Get a cake, with the given number of slices eaten.
     *
     * @param int $slicesEaten 0-6
     *
     * @throws \Exception
     */
    public function __construct($slicesEaten)
    {
        $this->setBlockIDFor(Ref::CAKE);
        $this->checkValue($slicesEaten, 0, 6, 'Invalid slices eaten for cake');
    }
}
