<?php

namespace MinecraftMapEditor\Block;

class Door extends \MinecraftMapEditor\Block
{
    const HALF_BOTTOM = 0b0000;
    const HALF_TOP    = 0b1000;

    const HINGE_RIGHT = 0x0;
    const HINGE_LEFT  = 0x1;

    const STATE_CLOSED = 0b0000;
    const STATE_OPEN   = 0b0100;

    const FACING_WEST  = 0x0;
    const FACING_NORTH = 0x1;
    const FACING_EAST  = 0x2;
    const FACING_SOUTH = 0x3;

    const POWER_UNPOWERED = 0b0000;
    const POWER_POWERED   = 0b0010;

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
     * @throws Exception
     */
    public function __construct($blockRef, $half, $hinge, $state, $facing, $power)
    {
        $block = self::checkBlock($blockRef, Ref::getStartsWith('DOOR_'));

        self::checkDataRefValidStartWith($half, 'HALF_', 'Invalid half for door');
        self::checkDataRefValidStartWith($hinge, 'HINGE_', 'Invalid hinge for door');
        self::checkDataRefValidStartWith($state, 'STATE_', 'Invalid state for door');
        self::checkDataRefValidStartWith($facing, 'FACING_', 'Invalid facing for door');
        self::checkDataRefValidStartWith($power, 'POWER_', 'Invalid power for door');

        switch ($half) {
            case HALF_BOTTOM:
                $data = $half | $facing | $state;
                break;
            case HALF_TOP:
                $data = $half | $hinge | $power;
                break;
        }

        parent::__construct($block[0], $data);
    }
}
