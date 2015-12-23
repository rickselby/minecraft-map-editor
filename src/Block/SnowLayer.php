<?php

namespace MinecraftMapEditor\Block;

class SnowLayer extends \MinecraftMapEditor\Block
{
    /**
     * Get snow layers, with the given number of layers.
     *
     * @param int $layers 1-8
     * 
     * @throws \Exception
     */
    public function __construct($layers = 1)
    {
        if ($layers < 1 || $layers > 8) {
            throw new \Exception('Invalid power for redstone wire');
        }

        $block = IDs::$list[Ref::SNOW_LAYER];

        parent::__construct($block[0], $layers - 1);
    }
}
