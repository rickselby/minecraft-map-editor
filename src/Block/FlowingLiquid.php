<?php

namespace MinecraftMapEditor\Block;

class FlowingLiquid extends \MinecraftMapEditor\Block
{
    /**
     * Flowing water or lava. Set the level - 0x0 is the highest, to 0x7 the lowest.
     * If level is 0x8, then it's a full block that is falling and only spreads downwards.
     *
     * @param int $blockRef Block reference
     * @param int $level    Level of liquid
     *
     * @throws Exception
     */
    public function __construct($blockRef, $level)
    {
        $block = self::checkBlock($blockRef, [
            Ref::LAVA_FLOWING,
            Ref::WATER_FLOWING,
        ]);

        if ($level < 0 || $level > 8) {
            throw new \Exception('Invalid level for flowing liquid');
        }

        parent::__construct($block[0], $level);
    }
}
