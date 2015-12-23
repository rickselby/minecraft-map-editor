<?php

namespace MinecraftMapEditor\Block;

class RedstoneRail extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const ORIENT_NORTH_SOUTH = 0x0;
    const ORIENT_EAST_WEST = 0x1;
    const ORIENT_SLOPED_EAST = 0x2;
    const ORIENT_SLOPED_WEST = 0x3;
    const ORIENT_SLOPED_NORTH = 0x4;
    const ORIENT_SLOPED_SOUTH = 0x5;

    const INACTIVE = 0b0000;
    const ACTIVE   = 0b1000;

    /**
     * Get a 'redstone rail' (powered, activator, detector), with the given
     * orientation and active status
     *
     * @param int $blockRef One of the Ref constants
     * @param int $orientation One of the ORIENT_ class constants
     * @param int $active Either RedstoneRail::INACTIVE or RedstoneRail::ACTIVE
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $orientation, $active = self::INACTIVE)
    {
        $block = $this->checkBlock($blockRef, Ref::getStartsWith('RAIL_'));

        $this->checkDataRefValidStartWith($orientation, 'ORIENT_', 'Invalid orientation for redstone rail');
        $this->checkInList($active, [self::INACTIVE, self::ACTIVE], 'Invalid active setting for redstone rail');

        parent::__construct($block[0], $orientation | $active);
    }
}
