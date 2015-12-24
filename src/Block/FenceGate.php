<?php

namespace MinecraftMapEditor\Block;

class FenceGate extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const FACING_SOUTH = 0;
    const FACING_WEST = 1;
    const FACING_NORTH = 2;
    const FACING_EAST = 3;

    const CLOSED = 0b0000;
    const OPEN = 0b0100;

    /**
     * Get the given fence gate, with the given direction and state.
     *
     * @param int $blockRef  BlockRef for the fence gate
     * @param int $direction Direction the gate is facing; one of the FACING_ class constants
     * @param int $open      Either FenceGate::CLOSED or FenceGate::OPEN
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $direction, $open)
    {
        $this->checkBlock($blockRef, Ref::getRegexp('/^FENCE_GATE_/'));

        $this->checkDataRefValidStartsWith($direction, 'FACING_', 'Invalid facing for fence gate');
        $this->checkInList($open, [self::CLOSED, self::OPEN], 'Invalid open for fence gate');

        $this->setBlockData($direction | $open);
    }
}
