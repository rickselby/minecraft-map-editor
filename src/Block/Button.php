<?php

namespace MME\Block;

class Button extends \MME\Block implements Interfaces\ActiveBit8
{
    use Traits\Create;

    const POSITION_DOWN = 0;
    const POSITION_EAST = 1;
    const POSITION_WEST = 2;
    const POSITION_SOUTH = 3;
    const POSITION_NORTH = 4;
    const POSITION_UP = 5;

    /**
     * Get a button, in the given position.
     *
     * @param int $blockRef One of the BUTTON_ blockRefs
     * @param int $position The position of the button; one of the POSITION_ class constants
     * @param int $active   Either Button::INACTIVE or Button::ACTIVE
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $position, $active)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('BUTTON_'));

        $this->checkDataRefValidStartsWith($position, 'POSITION_', 'Invalid position for button');
        $this->checkInList($active, [self::INACTIVE, self::ACTIVE], 'Invalid active setting for button');

        $this->setBlockData($position | $active);
    }
}
