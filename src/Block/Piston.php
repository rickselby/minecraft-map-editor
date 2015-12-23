<?php

namespace MinecraftMapEditor\Block;

class Piston extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const UP = 1;
    const DOWN = 0;
    const NORTH = 2;
    const EAST = 5;
    const SOUTH = 3;
    const WEST = 4;

    /**
     * Get a piston. If extended, this will only do the piston body, not the head
     *
     * @param int $blockRef  Which piston
     * @param int $direction The direction the piston head is pointing; one of the class constants
     * @param bool $extended [optional] Is the piston extended? TODO CHANGE THIS TO A CONST VALUE
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $direction, $extended = false)
    {
        $block = $this->checkBlock($blockRef, [
            Ref::PISTON,
            Ref::PISTON_STICKY,
        ]);

        $this->checkDataRefValidAll($direction, 'Invalid direction for piston');

        if ($extended) {
            $direction |= 8;
        }

        parent::__construct($block[0], $direction);
    }
}
