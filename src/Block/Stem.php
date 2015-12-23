<?php

namespace MinecraftMapEditor\Block;

class Stem extends \MinecraftMapEditor\Block\Shared\BasicValue
{
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

        parent::__construct($blockRef, $growth, 0, 7, 'Invalid growth for stem');
    }
}
