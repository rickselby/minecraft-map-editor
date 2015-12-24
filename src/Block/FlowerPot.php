<?php

namespace MinecraftMapEditor\Block;

class FlowerPot extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    public function __construct()
    {
        // This is going to define the plant in the tile entity data
        // - which is to be done...

        $this->setBlockIDAndDataFor(Ref::FLOWER_POT);
    }
}
