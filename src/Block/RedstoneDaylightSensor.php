<?php

namespace MinecraftMapEditor\Block;

class RedstoneDaylightSensor extends \MinecraftMapEditor\Block\Shared\BasicValue
{
    /**
     * Get a daylight sensor (regular or inverted) with the given power.
     *
     * @param int $blockRef The Daylight sensor type
     * @param int $power    Power level (0-15)
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $power)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('DAYLIGHT_SENSOR'));

        parent::__construct($blockRef, $power, 0, 15, 'Invalid power for Daylight Sensor');
    }
}
