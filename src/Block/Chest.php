<?php

namespace MinecraftMapEditor\Block;

class Chest extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const NORTH = 2;
    const SOUTH = 3;
    const EAST  = 4;
    const WEST  = 5;

    /**
     * Get a chest, facing in the given direction.
     *
     * @param int $blockRef  Chest block reference
     * @param int $direction Direction the chest is facing; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $direction)
    {
        $block = $this->checkBlock($blockRef, Ref::getStartsWith('CHEST'));

        $this->checkDataRefValidAll($direction, 'Invalid direction for chest');

        parent::__construct($block[0], $direction);
    }
}
