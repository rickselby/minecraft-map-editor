<?php

namespace MME\Block;

class Ladder extends \MME\Block implements Interfaces\FacingSouth3
{
    use Traits\Create;

    const ATTACH_SOUTH = 2;
    const ATTACH_NORTH = 3;
    const ATTACH_EAST = 4;
    const ATTACH_WEST = 5;

    /**
     * Get a ladder, facing the given direction.
     *
     * @param int $attached One of the class constants
     *
     * @throws \Exception
     */
    public function __construct($attached)
    {
        $this->setBlockIDFor(Ref::LADDER);

        $this->checkDataRefValidAll($attached, 'Invalid attached value for ladder');

        $this->setBlockData($attached);
    }
}
