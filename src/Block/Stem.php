<?php

namespace MinecraftMapEditor\Block;

class Stem extends \MinecraftMapEditor\Block
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
        $block = self::checkBlock($blockRef, Ref::getStartsWith('STEM_'));

        if ($growth < 0 || $growth > 7) {
            throw new \Exception('Invalid growth for stem');
        }

        parent::__construct($block[0], $growth);
    }
}
