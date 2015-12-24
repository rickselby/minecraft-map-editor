<?php

namespace MinecraftMapEditor\Block;

class MobHead extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const FLOOR = 1;
    const WALL_NORTH = 2;
    const WALL_SOUTH = 3;
    const WALL_EAST = 4;
    const WALL_WEST = 5;

    /**
     * Get a mob head, with the given placement.
     * (Which head it is will be in tile entity, to be implemented).
     *
     * @param int $placement One of the class constants
     *
     * @throws \Exception
     */
    public function __construct($placement)
    {
        $this->setBlockIDFor(Ref::MOB_HEAD);

        $this->checkDataRefValidAll($placement, 'Invalid placement for mob head');

        $this->setBlockData($placement);
    }
}
