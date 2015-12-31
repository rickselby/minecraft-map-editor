<?php

namespace MinecraftMapEditor\Block;

class Bed extends \MinecraftMapEditor\Block implements Interfaces\FacingSouth0
{
    use Traits\Create;

    const PART_FOOT = 0b0000;
    const PART_HEAD = 0b1000;

    /**
     * Get half a bed, given the direction (head facing) and which part.
     *
     * @param int $facing The direction the head of the bed is facing; one of the FACING_ class constants
     * @param int $part   The part of the bed; one of the PART_ class constants
     *
     * @throws \Exception
     */
    public function __construct($facing, $part)
    {
        $this->setBlockIDFor(Ref::BED);

        $this->checkDataRefValidStartsWith($facing, 'FACING_', 'Invalid facing direction for bed');
        $this->checkDataRefValidStartsWith($part, 'PART_', 'Invalid part for bed');

        $this->setBlockData($facing | $part);
    }
}
