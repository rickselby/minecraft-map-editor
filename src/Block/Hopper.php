<?php

namespace MinecraftMapEditor\Block;

class Hopper extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const OUTPUT_DOWN = 0;
    const OUTPUT_NORTH = 2;
    const OUTPUT_SOUTH = 3;
    const OUTPUT_WEST = 4;
    const OUTPUT_EAST = 5;

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
        $this->setBlockIDFor(Ref::HOPPER);

        $this->checkDataRefValidStartsWith($output, 'OUTPUT', 'Invalid output reference for hopper');
        $this->checkInList($active, [self::ACTIVE, self::DISABLED], 'Invalid active reference for hopper');

        $this->setBlockData($output | $active);
    }
}
