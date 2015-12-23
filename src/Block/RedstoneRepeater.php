<?php

namespace MinecraftMapEditor\Block;

class RedstoneRepeater extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const FACING_NORTH = 0x0;
    const FACING_EAST  = 0x1;
    const FACING_SOUTH = 0x2;
    const FACING_WEST  = 0x3;

    const DELAY_1 = 0b0000;
    const DELAY_2 = 0b0100;
    const DELAY_3 = 0b1000;
    const DELAY_4 = 0b1100;

    /**
     * Get a repeater, with the given orientation and delay ticks.
     *
     * @param int $blockRef Which repeater (on/off)
     * @param int $facing   One of the FACING_ class constants
     * @param int $delay    One of the DELAY_ class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $facing, $delay)
    {
        $block = $this->checkBlock($blockRef, Ref::getStartsWith('REDSTONE_REPEATER_'));

        $this->checkDataRefValidStartWith($facing, 'FACING_', 'Invalid facing setting for redstone repeater');
        $this->checkDataRefValidStartWith($delay, 'DELAY_', 'Invalid delay setting for redstone repeater');

        parent::__construct($block[0], $facing | $delay);
    }
}
