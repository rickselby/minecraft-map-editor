<?php

namespace MinecraftMapEditor\Block;

class Farmland extends \MinecraftMapEditor\Block
{
    /**
     * Get a farmland block, with the given wetness.
     *
     * @param int $wetness 0-7
     */
    public function __construct($wetness)
    {
        if ($wetness < 0 || $wetness > 7) {
            throw new \Exception('Invalid wetness for farmland');
        }

        $block = IDs::$list[Ref::FARMLAND];

        parent::__construct($block[0], $wetness);
    }
}
