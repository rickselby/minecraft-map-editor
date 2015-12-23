<?php

namespace MinecraftMapEditor\Block;

class FlowingLiquid extends Shared\BasicValue
{
    use Shared\Create;

    /**
     * Flowing water or lava. Set the level - 0x0 is the highest, to 0x7 the lowest.
     * If level is 0x8, then it's a full block that is falling and only spreads downwards.
     *
     * @param int $blockRef Block reference
     * @param int $level    Level of liquid
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $level)
    {
        $this->checkBlock($blockRef, [
            Ref::LAVA_FLOWING,
            Ref::WATER_FLOWING,
        ]);

        parent::__construct($blockRef, $level, 0, 8, 'Invalid level for '.Ref::getNameFor($blockRef));
    }
}
