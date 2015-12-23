<?php

namespace MinecraftMapEditor\Block;

class TripwireHook extends \MinecraftMapEditor\Block
{
    const FACING_SOUTH = 0x0;
    const FACING_WEST  = 0x1;
    const FACING_NORTH = 0x2;
    const FACING_EAST  = 0x3;

    const NOT_CONNECTED = 0b0000;
    const CONNECTED     = 0b0100;
    const ACTIVATED     = 0b1000;

    /**
     * Get a tripwire hook facing the given way with the given state.
     *
     * @param int $facing One of the FACING_ class constants
     * @param int $state  Either TripwireHook::NOT_CONNECTED, TripwireHook::CONNECTED
     *                    or TripwireHook::ACTIVATED
     *
     * @throws \Exception
     */
    public function __construct($facing, $state)
    {
        $block = IDs::$list[Ref::TRIPWIRE_HOOK];

        self::checkDataRefValidStartWith($facing, 'FACING_', 'Invalid facing setting for tripwire hook');
        self::checkInList(
            $state,
            [self::NOT_CONNECTED, self::CONNECTED, self::ACTIVATED],
            'Invalid state for tripwire hook'
        );

        parent::__construct($block[0], $facing | $state);
    }
}
