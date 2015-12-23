<?php

namespace MinecraftMapEditor\Block;

class Hopper extends \MinecraftMapEditor\Block
{
    const OUTPUT_DOWN = 0x0;
    const OUTPUT_NORTH = 0x2;
    const OUTPUT_SOUTH = 0x3;
    const OUTPUT_WEST = 0x4;
    const OUTPUT_EAST = 0x5;

    const ACTIVE = 0b0000;
    const DISABLED = 0b1000;

    /**
     * Get a hopper, with the output in the given direction.
     *
     * @param int $output Output direction; one of the OUTPUT_ class constants
     * @param int $active [Optional] Either Hopper::ACTIVE or Hopper::DISABLED
     *
     * @throws \Exception
     */
    public function __construct($output, $active = self::ACTIVE)
    {
        $block = IDs::$list[Ref::HOPPER];

        $this->checkDataRefValidStartWith($output, 'OUTPUT', 'Invalid output reference for hopper');
        $this->checkInList($active, [self::ACTIVE, self::DISABLED], 'Invalid active reference for hopper');

        parent::__construct($block[0], $output | $active);
    }
}
