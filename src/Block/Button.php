<?php

namespace MME\Block;

class Button extends \MME\Block implements Interfaces\ActiveBit8, Interfaces\AttachSouth4
{
    use Traits\Create;

    const ATTACH_TOP = 0;
    const ATTACH_BOTTOM = 5;

    /**
     * Get a button, in the given position.
     *
     * @param int $blockRef One of the BUTTON_ blockRefs
     * @param int $position The position of the button; one of the POSITION_ class constants
     * @param int $active   [Optional] Either Button::INACTIVE or Button::ACTIVE
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $position, $active = self::INACTIVE)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('BUTTON_'));

        $this->checkDataRefValidStartsWith($position, 'ATTACH_', 'Invalid position for button');
        $this->checkInList($active, [self::INACTIVE, self::ACTIVE], 'Invalid active setting for button');

        $this->setBlockData($position | $active);
    }
}
