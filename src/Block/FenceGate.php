<?php

namespace MinecraftMapEditor\Block;

class FenceGate extends \MinecraftMapEditor\Block
{
    const FACING_SOUTH = 0x0;
    const FACING_WEST = 0x1;
    const FACING_NORTH = 0x2;
    const FACING_EAST = 0x3;

    const CLOSED = 0x00;
    const OPEN = 0x04;

    /**
     * Get the given fence gate, with the given direction and state.
     *
     * @param int $blockRef  BlockRef for the fence gate
     * @param int $direction Direction the gate is facing; one of the FACING_ class constants
     * @param int $open      Either FenceGate::CLOSED or FenceGate::OPEN
     *
     * @throws Exception
     */
    public function __construct($blockRef, $direction, $open)
    {
        $block = self::checkBlock($blockRef, Ref::getRegexp('/^FENCE_GATE_/'));

        self::checkDataRefValidStartWith($direction, 'FACING_', 'Invalid facing for fence gate');
        self::checkInList($open, [self::CLOSED, self::OPEN], 'Invalid open for fence gate');

        parent::__construct($block[0], $direction | $open);
    }
}
