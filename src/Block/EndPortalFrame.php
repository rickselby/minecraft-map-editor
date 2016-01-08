<?php

namespace MME\Block;

class EndPortalFrame extends \MME\Block implements Interfaces\FacingSouth0
{
    use Traits\Create;

    const NOT_FILLED = 0b0000;
    const FILLED = 0b0100;

    /**
     * Get an end portal frame block, with the given direction, filled or not.
     *
     * @param int $facing Direction the block is facing
     * @param int $filled [Optional] Is there an eye of ender in the block?
     *
     * @throws \Exception
     */
    public function __construct($facing, $filled = self::NOT_FILLED)
    {
        $this->setBlockIDFor(Ref::END_PORTAL_FRAME);

        $this->checkDataRefValidStartsWith($facing, 'FACING_', 'Invalid facing direction for end portal frame');
        $this->checkInList($filled, [self::NOT_FILLED, self::FILLED], 'Invalid filled setting for end portal frame');

        $this->setBlockData($facing | $filled);
    }
}
