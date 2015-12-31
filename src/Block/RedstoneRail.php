<?php

namespace MinecraftMapEditor\Block;

class RedstoneRail extends \MinecraftMapEditor\Block
    implements Interfaces\ActiveBit8, Interfaces\StraightRail
{
    use Traits\Create;

    /**
     * Get a 'redstone rail' (powered, activator, detector), with the given
     * orientation and active status.
     *
     * @param int $blockRef    One of the Ref constants
     * @param int $orientation One of the ORIENT_ class constants (in StraightRail)
     * @param int $active      Either RedstoneRail::INACTIVE or RedstoneRail::ACTIVE
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $orientation, $active = self::INACTIVE)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('RAIL_'));

        $this->checkDataRefValidStartsWith($orientation, 'ORIENT_', 'Invalid orientation for redstone rail');
        $this->checkInList($active, [self::INACTIVE, self::ACTIVE], 'Invalid active setting for redstone rail');

        $this->setBlockData($orientation | $active);
    }
}
