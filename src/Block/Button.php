<?php

namespace MinecraftMapEditor\Block;

class Button extends \MinecraftMapEditor\Block
{
    const POSITION_DOWN  = 0x0;
    const POSITION_EAST  = 0x1;
    const POSITION_WEST  = 0x2;
    const POSITION_SOUTH = 0x3;
    const POSITION_NORTH = 0x4;
    const POSITION_UP    = 0x5;

    const INACTIVE = 0b0000;
    const ACTIVE   = 0b1000;

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
        $block = $this->checkBlock($blockRef, Ref::getStartsWith('BUTTON_'));

        $this->checkDataRefValidStartWith($position, 'POSITION_', 'Invalid position for button');
        $this->checkInList($active, [self::INACTIVE, self::ACTIVE], 'Invalid active setting for button');

        parent::__construct($block[0], $position | $active);
    }
}
