<?php

namespace MinecraftMapEditor\Block;

class Ladder extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const NORTH = 2;
    const SOUTH = 3;
    const WEST = 4;
    const EAST = 5;

    /**
     * Get a ladder, facing the given direction.
     *
     * @param int $facing One of the class constants
     *
     * @throws \Exception
     */
    public function __construct($facing)
    {
        $this->setBlockIDFor(Ref::LADDER);

        $this->checkDataRefValidAll($facing, 'Invalid facing value for ladder');

        $this->setBlockData($facing);
    }
}
