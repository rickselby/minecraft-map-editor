<?php

namespace MinecraftMapEditor\Block;

class SnowLayer extends Shared\BasicValue
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
        parent::__construct(Ref::SNOW_LAYER, $layers - 1, 0, 7, 'Invalid power for redstone wire');
    }
}
