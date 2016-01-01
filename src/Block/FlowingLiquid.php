<?php

namespace MME\Block;

class FlowingLiquid extends \MME\Block
{
    use Traits\BasicValue, Traits\Create;

    /**
     * Flowing water or lava. Set the level - 0 is the highest, to 7 the lowest.
     * If level is 8, then it's a full block that is falling and only spreads downwards.
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

        $this->checkValue($level, 0, 15, 'Invalid level for '.Ref::getNameFor($blockRef));
    }
}
