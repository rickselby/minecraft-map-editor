<?php

namespace MinecraftMapEditor\Block;

class PistonHead extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const DIRECTION_DOWN = 0;
    const DIRECTION_UP = 1;
    const DIRECTION_NORTH = 2;
    const DIRECTION_SOUTH = 3;
    const DIRECTION_WEST = 4;
    const DIRECTION_EAST = 5;

    const STICKY = 0b1000;
    const NORMAL = 0b0000;

    /**
     * Get a piston head of the given type facing the given direction.
     *
     * @param type $type      Either PistonHead::STICKY or PistonHead::NORMAL
     * @param type $direction One of the DIRECTION_ class constants
     *
     * @throws \Exception
     */
    public function __construct($type, $direction)
    {
        $this->setBlockIDFor(Ref::PISTON_HEAD);

        $this->checkInList($type, [self::STICKY, self::NORMAL], 'Invalid type for piston head');
        $this->checkDataRefValidStartsWith($direction, 'DIRECTION_', 'Invalid direction for piston head');

        $this->setBlockData($type | $direction);
    }
}
