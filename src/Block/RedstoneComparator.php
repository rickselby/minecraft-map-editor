<?php

namespace MinecraftMapEditor\Block;

class RedstoneComparator extends \MinecraftMapEditor\Block
{
    use Traits\Create, Traits\EntityData, Traits\CheckValue;

    const FACING_NORTH = 1;
    const FACING_EAST = 2;
    const FACING_SOUTH = 3;
    const FACING_WEST = 4;

    const MODE_NORMAL = 0b0000;
    const MODE_SUBTRACTION = 0b0100;

    const UNPOWERED = 0b0000;
    const POWERED = 0b1000;

    /**
     * Get a comparator with the given settings.
     *
     * @param int $facing  Direction the comparator is facing; one of the FACING_ class constants
     * @param int $mode    Which mode the comparator is in; one of the MODE_ class constants
     * @param int $powered Either RedstoneComparator::UNPOWERED or RedstoneComparator::POWERED#
     * @param int $outputSignal Strength of output signal
     *
     * @throws \Exception
     */
    public function __construct($facing, $mode, $powered = self::UNPOWERED, $outputSignal = 0)
    {
        $this->setBlockIDFor(Ref::REDSTONE_COMPARATOR);

        $this->checkDataRefValidStartsWith($facing, 'FACING_', 'Invalid facing status for comparator');
        $this->checkDataRefValidStartsWith($mode, 'MODE_', 'Invalid mode for comparator');
        $this->checkInList($powered, [self::UNPOWERED, self::POWERED], 'Invalid powered setting for comparator');

        $this->setBlockData($facing | $mode | $powered);

        $this->initEntityData('Comparator');
        $this->checkValue($outputSignal, 0, 15, 'Invalid Output Signal Stregth for comparator');
        $this->entityData->addChild(\Nbt\Tag::tagInt('OutputSignal', $outputSignal));
    }
}
