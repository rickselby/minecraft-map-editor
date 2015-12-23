<?php

namespace MinecraftMapEditor\Block;

class Crops extends \MinecraftMapEditor\Block\Shared\BasicValue
{
    /**
     * Get a crop (wheat, carrots, potatoes) at the given growth.
     *
     * @param int $blockRef Block reference for the required crop
     * @param int $growth   Growth level, 0-7
     */
    public function __construct($blockRef, $growth)
    {
        $this->checkBlock($blockRef, [
            Ref::WHEAT,
            Ref::CARROTS,
            Ref::POTATOES,
        ]);

        parent::__construct($blockRef, $growth, 0, 7, 'Invalid growth for crop '.Ref::getNameFor($blockRef));
    }
}
