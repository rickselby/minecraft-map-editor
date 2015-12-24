<?php

namespace MinecraftMapEditor\Block;

class Beacon extends \MinecraftMapEditor\Block
{
    use Traits\Create, Traits\EntityData;

    const POWER_NONE = 0;
    const POWER_SPEED = 1;
    const POWER_HASTE = 3;
    const POWER_RESISTANCE = 11;
    const POWER_JUMP = 8;
    const POWER_STRENGTH = 5;

    const SECONDARY_NONE = 0;
    const SECONDARY_DOUBLE = -1;
    const SECONDARY_REGENERATION = 10;

    /**
     * Get a beacon with the given settings
     *
     * @param int $primaryPower
     * @param int $secondaryPower
     * @param int $levels
     * @param string|null $lock
     */
    public function __construct($primaryPower, $secondaryPower, $levels, $lock = null)
    {
        $this->setBlockIDAndDataFor(Ref::BEACON);

        $this->initEntityData('Beacon');

        // Set primary power
        $this->checkDataRefValidStartsWith($primaryPower, 'POWER_', 'Invalid primary power for beacon');
        $this->entityData->addChild(\Nbt\Tag::tagInt('Primary', $primaryPower));

        // Might be worth looking at data for secondary power... how the level 2 thing works

    }
}
