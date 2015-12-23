<?php

namespace MinecraftMapEditor\Block;

class Cocoa extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const ATTACHED_NORTH = 0;
    const ATTACHED_SOUTH = 1;
    const ATTACHED_EAST  = 2;
    const ATTACHED_WEST  = 3;

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
        $this->checkDataRefValidStartWith($attached, 'ATTACHED_', 'Invalid attachment setting for Cocoa');
        $this->checkDataRefValidStartWith($stage, 'STAGE_', 'Invalid stage setting for Cocoa');

        $block = IDs::$list[Ref::COCOA];

        // Stage is in bits 3 and 4, so shift it
        parent::__construct($block[0], $attached | $stage);
    }
}
