<?php

namespace MinecraftMapEditor\Block;

class Stairs extends \MinecraftMapEditor\Block
{
    const ORIENT_EAST  = 0x0;
    const ORIENT_WEST  = 0x1;
    const ORIENT_SOUTH = 0x2;
    const ORIENT_NORTH = 0x3;

    const RIGHT_WAY_UP = 0b0000;
    const UPSIDE_DOWN  = 0b0100;

    /**
     * Get stairs, with the given orientation and way up.
     *
     * @param int $blockRef    Which type of stairs
     * @param int $orientation One of the ORIENT_ class constants
     * @param int $wayUp       [Optional] Either Stairs::RIGHT_WAY_UP or Stairs::UPSIDE_DOWN
     */
    public function __construct($blockRef, $orientation, $wayUp = self::RIGHT_WAY_UP)
    {
        $block = self::checkBlock($blockRef, Ref::getStartsWith('STAIRS_'));

        self::checkDataRefValidStartWith($orientation, 'ORIENT_', 'Invalid orientation for stairs');
        self::checkInList($wayUp, [self::RIGHT_WAY_UP, self::UPSIDE_DOWN], 'Invalid way up for stairs');

        parent::__construct($block[0], $orientation | $wayUp);
    }
}