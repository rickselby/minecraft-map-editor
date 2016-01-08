<?php

namespace MME\Block;

class Crops extends \MME\Block
{
    use Traits\BasicValue, Traits\Create;

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

        $this->checkValue($growth, 0, 7, 'Invalid growth for crop '.Ref::getNameFor($blockRef));
    }
}
