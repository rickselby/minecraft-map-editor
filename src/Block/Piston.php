<?php

namespace MinecraftMapEditor\Block;

class Piston extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    const FACING_UP = 1;
    const FACING_DOWN = 0;
    const FACING_NORTH = 2;
    const FACING_EAST = 5;
    const FACING_SOUTH = 3;
    const FACING_WEST = 4;

    const EXTENDED = 0b1000;
    const RETRACTED = 0b0000;

    /**
     * Get a piston. If extended, this will only do the piston body, not the head.
     *
     * @param int $blockRef Which piston
     * @param int $facing   The direction the piston head is pointing; one of the class constants
     * @param int $extended Either Piston::EXTENDED or Piston::RETRACTED
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $facing, $extended = self::RETRACTED)
    {
        $this->checkBlock($blockRef, [
            Ref::PISTON,
            Ref::PISTON_STICKY,
        ]);

        $this->checkDataRefValidStartsWith($facing, 'FACING_', 'Invalid facing setting for piston');
        $this->checkInList($extended, [self::EXTENDED, self::RETRACTED], 'Invalid extended setting for piston');

        $this->setBlockData($facing | $extended);
    }
}
