<?php

namespace MinecraftMapEditor\Block;

class EndPortalFrame extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const DIRECTION_SOUTH = 0x0;
    const DIRECTION_WEST = 0x1;
    const DIRECTION_NORTH = 0x2;
    const DIRECTION_EAST = 0x3;

    const NOT_FILLED = 0b0000;
    const FILLED = 0b0100;

    /**
     * Get an end portal frame block, with the given direction, filled or not.
     *
     * @param int  $direction Direction the block is facing
     * @param int $filled    [Optional] Is there an eye of ender in the block?
     *
     * @throws \Exception
     */
    public function __construct($direction, $filled = self::NOT_FILLED)
    {
        $block = IDs::$list[Ref::END_PORTAL_FRAME];

        $this->checkDataRefValidStartWith($direction, 'DIRECTION_', 'Invalid direction for end portal frame');
        $this->checkInList($filled, [self::NOT_FILLED, self::FILLED], 'Invalid filled setting for end portal frame');

        parent::__construct($block[0], $direction | $filled);
    }
}
