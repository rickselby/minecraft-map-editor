<?php

namespace MME\Block;

class Cocoa extends \MME\Block
{
    use Traits\Create;

    const ATTACHED_NORTH = 0;
    const ATTACHED_EAST = 1;
    const ATTACHED_SOUTH = 2;
    const ATTACHED_WEST = 3;

    const STAGE_1 = 0b0000;
    const STAGE_2 = 0b0100;
    const STAGE_3 = 0b1000;

    /**
     * Get a cocoa pod, with given attachment and growth stage.
     *
     * @param int $attached One of the ATTACHED_ class constants
     * @param int $stage    One of the STAGE_ class constants
     *
     * @throws \Exception
     */
    public function __construct($attached, $stage)
    {
        $this->setBlockIDFor(Ref::COCOA);

        $this->checkDataRefValidStartsWith($attached, 'ATTACHED_', 'Invalid attachment setting for Cocoa');
        $this->checkDataRefValidStartsWith($stage, 'STAGE_', 'Invalid stage setting for Cocoa');

        $this->setBlockData($attached | $stage);
    }
}
