<?php

namespace MinecraftMapEditor\Block;

class RedstoneRepeater extends \MinecraftMapEditor\Block implements Interfaces\FacingSouth2
{
    use Traits\Create;

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
        $this->checkBlock($blockRef, Ref::getStartsWith('REDSTONE_REPEATER_'));

        $this->checkDataRefValidStartsWith($facing, 'FACING_', 'Invalid facing setting for redstone repeater');
        $this->checkDataRefValidStartsWith($delay, 'DELAY_', 'Invalid delay setting for redstone repeater');

        $this->setBlockData($facing | $delay);
    }
}
