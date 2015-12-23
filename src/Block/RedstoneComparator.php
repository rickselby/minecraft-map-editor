<?php

namespace MinecraftMapEditor\Block;

class RedstoneComparator extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const FACING_NORTH = 0x1;
    const FACING_EAST = 0x2;
    const FACING_SOUTH = 0x3;
    const FACING_WEST = 0x4;

    const MODE_NORMAL = 0b0000;
    const MODE_SUBTRACTION = 0b0100;

    const UNPOWERED = 0b0000;
    const POWERED = 0b1000;

    /**
     * Get a comparator with the given settings.
     *
     * @param int $facing  Direction the comparator is facing; one of the FACING_ class constants
     * @param int $mode    Which mode the comparator is in; one of the MODE_ class constants
     * @param int $powered Either RedstoneComparator::UNPOWERED or RedstoneComparator::POWERED
     *
     * @throws \Exception
     */
    public function __construct($facing, $mode, $powered = self::UNPOWERED)
    {
        $block = IDs::$list[Ref::REDSTONE_COMPARATOR];

        $this->checkDataRefValidStartWith($facing, 'FACING_', 'Invalid facing status for comparator');
        $this->checkDataRefValidStartWith($mode, 'MODE_', 'Invalid mode for comparator');
        $this->checkInList($powered, [self::UNPOWERED, self::POWERED], 'Invalid powered setting for comparator');

        parent::__construct($block[0], $facing | $mode | $powered);
    }
}
