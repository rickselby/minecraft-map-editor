<?php

namespace MME\Block;

class Stem extends \MME\Block
{
    use Traits\BasicValue, Traits\Create;

    /**
     * Get a stem with the given growth setting (7 = ready to spawn item).
     *
     * @param int $blockRef Which stem to place
     * @param int $growth   Growth level, 0-7
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $growth)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('STEM_'));

        $this->checkValue($growth, 0, 7, 'Invalid growth for stem');
    }
}
