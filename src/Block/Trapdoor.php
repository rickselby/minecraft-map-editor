<?php

namespace MinecraftMapEditor\Block;

class Trapdoor extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const HINGE_SOUTH = 0;
    const HINGE_NORTH = 1;
    const HINGE_EAST = 2;
    const HINGE_WEST = 3;

    const DOOR_CLOSED = 0b0000;
    const DOOR_OPEN = 0b0100;

    const ON_BOTTOM = 0b0000;
    const ON_TOP = 0b1000;

    /**
     * Get a trap door, with the given hinge side, top/bottom, and state.
     *
     * @param type $blockRef Which trap door
     * @param type $hinge    One of the HINGE_ class constants
     * @param type $half     One of the ON_ class constants
     * @param type $state    One of the DOOR_ class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $hinge, $half, $state = self::DOOR_CLOSED)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('TRAPDOOR_'));

        $this->checkDataRefValidStartsWith($hinge, 'HINGE_', 'Invalid hinge setting for trapdoor');
        $this->checkDataRefValidStartsWith($half, 'ON_', 'Invalid top/bottom setting for trapdoor');
        $this->checkDataRefValidStartsWith($state, 'DOOR_', 'Invalid state for trapdoor');

        $this->setBlockData($hinge | $half | $state);
    }
}
