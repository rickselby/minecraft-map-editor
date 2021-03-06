<?php

namespace MME\Block;

class Door extends \MME\Block implements Interfaces\DoorOpen
{
    use Traits\Create;

    const HALF_BOTTOM = 0b0000;
    const HALF_TOP = 0b1000;

    const HINGE_RIGHT = 0;
    const HINGE_LEFT = 1;

    const FACING_WEST = 0;
    const FACING_NORTH = 1;
    const FACING_EAST = 2;
    const FACING_SOUTH = 3;

    const POWER_UNPOWERED = 0b0000;
    const POWER_POWERED = 0b0010;

    /**
     * Get half of a door. Certain settings are used on certain halves, but we
     * ask for them all anyway. Saves two separate functions.
     *
     * @param int $blockRef BlockRef for the type of door
     * @param int $half     Which half of the door; one of the HALF_ class consts
     * @param int $hinge    Which side the door is hinged on; one of the HINGE_ class constants
     * @param int $state    Whether the door is open or closed; one of the STATE_ class constants
     * @param int $facing   Which direction the door faces when closed; one of the FACING_ class constants
     * @param int $power    Whether the door is powered or not; one of the POWER_ class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $half, $hinge, $state, $facing, $power)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('DOOR_'));

        $this->checkDataRefValidStartsWith($half, 'HALF_', 'Invalid half for door');
        $this->checkDataRefValidStartsWith($hinge, 'HINGE_', 'Invalid hinge for door');
        $this->checkDataRefValidStartsWith($state, 'STATE_', 'Invalid state for door');
        $this->checkDataRefValidStartsWith($facing, 'FACING_', 'Invalid facing for door');
        $this->checkDataRefValidStartsWith($power, 'POWER_', 'Invalid power for door');

        switch ($half) {
            case self::HALF_BOTTOM:
                $this->setBlockData($half | $facing | $state);
                break;
            case self::HALF_TOP:
                $this->setBlockData($half | $hinge | $power);
                break;
        }
    }
}
