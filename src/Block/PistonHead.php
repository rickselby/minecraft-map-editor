<?php

namespace MME\Block;

class PistonHead extends \MME\Block implements Interfaces\OutputFull
{
    use Traits\Create;

    const STICKY = 0b1000;
    const NORMAL = 0b0000;

    /**
     * Get a piston head of the given type facing the given direction.
     *
     * @param type $type      Either PistonHead::STICKY or PistonHead::NORMAL
     * @param type $direction One of the OUTPUT_ class constants
     *
     * @throws \Exception
     */
    public function __construct($type, $direction)
    {
        $this->setBlockIDFor(Ref::PISTON_HEAD);

        $this->checkInList($type, [self::STICKY, self::NORMAL], 'Invalid type for piston head');
        $this->checkDataRefValidStartsWith($direction, 'OUTPUT_', 'Invalid direction for piston head');

        $this->setBlockData($type | $direction);
    }
}
