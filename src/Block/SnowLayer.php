<?php

namespace MME\Block;

class SnowLayer extends \MME\Block
{
    use Traits\BasicValue, Traits\Create;

    /**
     * Get snow layers, with the given number of layers.
     *
     * @param int $layers 1-8
     *
     * @throws \Exception
     */
    public function __construct($layers = 1)
    {
        $this->setBlockIDFor(Ref::SNOW_LAYER);
        $this->checkValue($layers - 1, 0, 7, 'Invalid number of snow layer');
    }
}
