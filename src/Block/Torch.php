<?php

namespace MinecraftMapEditor\Block;

class Torch extends \MinecraftMapEditor\Block
{
    use Shared\Create;

    const WEST = 1;
    const EAST = 2;
    const NORTH = 3;
    const SOUTH = 4;
    const STANDING = 5;

    /**
     * Get a torch with a given attatchment.
     *
     * @param int $blockRef   Block reference from Block\Ref
     * @param int $attachment Attachment direction; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $attachment)
    {
        $block = $this->checkBlock($blockRef, [
            Ref::TORCH,
            Ref::REDSTONE_TORCH_OFF,
            Ref::REDSTONE_TORCH_ON,
        ]);

        // Check the orientation is valid
        $this->checkDataRefValidAll($attachment, 'Invalid attachment for torch');

        parent::__construct($block[0], $attachment);
    }
}
