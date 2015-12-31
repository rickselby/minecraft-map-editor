<?php

namespace MinecraftMapEditor\Block;

class Pumpkin extends \MinecraftMapEditor\Block implements Interfaces\FacingSouth0
{
    use Traits\Create;

    const NO_FACE = 4;

    /**
     * Get a pumpkin or a jack o' lantern, facing the given direction
     * (or with no face at all).
     *
     * @param int $blockRef  Which pumpkin
     * @param int $direction One of the class constants
     */
    public function __construct($blockRef, $direction)
    {
        $this->checkBlock($blockRef, [Ref::PUMPKIN, Ref::JACK_O_LANTERN]);

        $this->checkDataRefValidAll($direction, 'Invalid direction for pumpkin');

        $this->setBlockData($direction);
    }
}
