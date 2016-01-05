<?php

namespace MME\Block;

class Vines extends \MME\Block
{
    use Traits\BasicValue, Traits\Create;

    const SOUTH = 0b0001;
    const WEST = 0b0010;
    const NORTH = 0b0100;
    const EAST = 0b1000;

    /**
     * Get vines. If vines are on multiple sides, use the | operator
     * e.g. (Vines::SOUTH | Vines::EAST).
     *
     * @param int $sides Mix of the class constants
     *
     * @throws \Exception
     */
    public function __construct($sides)
    {
        $this->setBlockIDFor(Ref::VINES);
        if (is_array($sides)) {
            $newSides = 0;
            foreach($sides AS $side) {
                $newSides |= $side;
            }
            $sides = $newSides;
        }
        $this->checkValue($sides, 1, 15, 'Invalid sides for vines');
    }
}
