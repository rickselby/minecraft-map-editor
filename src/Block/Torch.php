<?php

namespace MinecraftMapEditor\Block;

class Torch extends \MinecraftMapEditor\Block
{
    const WEST = 0x1;
    const EAST = 0x2;
    const NORTH = 0x3;
    const SOUTH = 0x4;
    const STANDING = 0x5;

    /**
     * Get a torch with a given attatchment.
     *
     * @param int $blockRef   Block reference from Block\Ref
     * @param int $attachment Attachment direction; one of the class constants
     *
     * @throws Exception
     */
    public function __construct($blockRef, $attachment)
    {
        $block = self::checkBlock($blockRef, [
            Ref::TORCH,
            Ref::REDSTONE_TORCH_OFF,
            Ref::REDSTONE_TORCH_ON,
        ]);

        // Check the orientation is valid
        self::checkDataRefValidAll($attachment, 'Invalid attachment for torch');

        parent::__construct($block[0], $attachment);
    }
}
