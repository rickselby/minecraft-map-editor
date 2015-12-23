<?php

namespace MinecraftMapEditor\Block;

class Anvil extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const DAMAGE_NONE   = 0b0000;
    const DAMAGE_SLIGHT = 0b0100;
    const DAMAGE_VERY   = 0b1000;

    const DIRECTION_NORTH_SOUTH = 0;
    const DIRECTION_EAST_WEST   = 1;
    const DIRECTION_SOUTH_NORTH = 2;
    const DIRECTION_WEST_EAST   = 3;

    /**
     * Get an anvil, with given damage setting and direction.
     *
     * @param int $damage    The damage setting of the anvil; one of the DAMAGE_ class constants
     * @param int $direction The direction of the anvil; one of the DIRECTION_ class constants
     *
     * @throws \Exception
     */
    public function __construct($damage, $direction)
    {
        $this->checkDataRefValidStartsWith($damage, 'DAMAGE_', 'Invalid damage for anvil');
        $this->checkDataRefValidStartsWith($direction, 'DIRECTION_', 'Invalid direction for anvil');

        $block = IDs::$list[Ref::ANVIL];

        parent::__construct($block[0], $damage | $direction);
    }
}
