<?php

namespace MinecraftMapEditor\Block;

class RedstoneDaylightSensor extends \MinecraftMapEditor\Block
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
        if ($power < 0 || $power > 15) {
            throw new \Exception('Invalid power for Daylight Sensor');
        }

        $block = self::checkBlock($blockRef, Ref::getStartsWith('DAYLIGHT_SENSOR'));

        parent::__construct($block[0], $power);
    }
}
