<?php

namespace MinecraftMapEditor\Block;

class Crops extends \MinecraftMapEditor\Block
{
    /**
     * Get a crop (wheat, carrots, potatoes) at the given growth.
     *
     * @param int $blockRef Block reference for the required crop
     * @param int $growth   Growth level, 0-7
     */
    public function __construct($blockRef, $growth)
    {
        $block = self::checkBlock($blockRef, [
            Ref::WHEAT,
            Ref::CARROTS,
            Ref::POTATOES,
        ]);

        if ($growth < 0 || $growth > 7) {
            throw new \Exception('Invalid growth for crop');
        }

        parent::__construct($block[0], $growth);
    }
}
