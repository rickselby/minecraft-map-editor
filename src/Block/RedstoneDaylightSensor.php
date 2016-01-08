<?php

namespace MME\Block;

class RedstoneDaylightSensor extends \MME\Block
{
    use Traits\BasicValue, Traits\Create, Traits\EntityData;

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

        $this->checkValue($power, 0, 15, 'Invalid power for Daylight Sensor');

        $this->initEntityData('DLDetector');
    }
}
