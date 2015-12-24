<?php

namespace MinecraftMapEditor\Block;

class Stairs extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const ORIENT_EAST = 0;
    const ORIENT_WEST = 1;
    const ORIENT_SOUTH = 2;
    const ORIENT_NORTH = 3;

    const RIGHT_WAY_UP = 0b0000;
    const UPSIDE_DOWN = 0b0100;

    /**
     * Get stairs, with the given orientation and way up.
     *
     * @param int $blockRef    Which type of stairs
     * @param int $orientation One of the ORIENT_ class constants
     * @param int $wayUp       [Optional] Either Stairs::RIGHT_WAY_UP or Stairs::UPSIDE_DOWN
     */
    public function __construct($blockRef, $orientation, $wayUp = self::RIGHT_WAY_UP)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('STAIRS_'));

        $this->checkDataRefValidStartsWith($orientation, 'ORIENT_', 'Invalid orientation for stairs');
        $this->checkInList($wayUp, [self::RIGHT_WAY_UP, self::UPSIDE_DOWN], 'Invalid way up for stairs');

        $this->setBlockData($orientation | $wayUp);
    }
}
