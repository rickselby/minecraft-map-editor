<?php

namespace MME\Block;

class Torch extends \MME\Block implements Interfaces\AttachSouth4
{
    use Traits\Create;

    const STANDING = 5;

    /**
     * Get a torch with a given attachment.
     *
     * @param int $blockRef   Block reference from Block\Ref
     * @param int $attachment Attachment direction; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $attachment)
    {
        $this->checkBlock($blockRef, [
            Ref::TORCH,
            Ref::REDSTONE_TORCH_OFF,
            Ref::REDSTONE_TORCH_ON,
        ]);

        // Check the orientation is valid
        $this->checkDataRefValidAll($attachment, 'Invalid attachment for torch');

        $this->setBlockData($attachment);
    }
}
