<?php

namespace MME\Block;

class Beacon extends \MME\Block
{
    use Traits\Create, Traits\EntityData, Traits\CheckValue;

    const POWER_NONE = 0;
    const POWER_SPEED = 1;
    const POWER_HASTE = 3;
    const POWER_RESISTANCE = 11;
    const POWER_JUMP = 8;
    const POWER_STRENGTH = 5;
    const POWER_REGENERATION = 10;

    /**
     * Get a beacon with the given settings.
     *
     * @param int    $primaryPower   Primary power given by the beacon
     * @param int    $secondaryPower Secondary power given by the beacon
     * @param int    $levels         Levels provided by the beacon
     * @param string $lock           Lock the beacon so it can only be opened if the player
     *                               is holding an item whose name matches this string
     */
    public function __construct($primaryPower, $secondaryPower, $levels, $lock = '')
    {
        $this->setBlockIDAndDataFor(Ref::BEACON);

        $this->initEntityData('Beacon');

        // Set primary power
        $this->checkInList($primaryPower, [
            self::POWER_HASTE,
            self::POWER_JUMP,
            self::POWER_NONE,
            self::POWER_RESISTANCE,
            self::POWER_SPEED,
            self::POWER_STRENGTH,
        ], 'Invalid primary power for beacon');

        $this->entityData->addChild(\Nbt\Tag::tagInt('Primary', $primaryPower));

        $this->checkInList($secondaryPower, [
            $primaryPower,
            self::POWER_NONE,
            self::POWER_REGENERATION,
        ], 'Invalid secondary power for beacon');

        $this->entityData->addChild(\Nbt\Tag::tagInt('Secondary', $secondaryPower));

        $this->checkValue($levels, 0, 4, 'Invalid levels for beacon');
        $this->entityData->addChild(\Nbt\Tag::tagInt('Levels', $secondaryPower));

        $this->entityData->addChild(\Nbt\Tag::tagString('Lock', $lock));
    }
}
