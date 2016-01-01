<?php

namespace MME\Block;

class Ladder extends \MME\Block implements Interfaces\FacingSouth3
{
    use Traits\Create;

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
