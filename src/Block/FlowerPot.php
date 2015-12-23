<?php

namespace MinecraftMapEditor\Block;

class FlowerPot extends \MinecraftMapEditor\Block
{
    public function __construct()
    {
        // This is going to define the plant in the tile entity data
        // - which is to be done...

        $block = IDs::$list[Ref::FLOWER_POT];
        parent::__construct($block[0], $block[1]);
    }

}
