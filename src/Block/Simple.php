<?php

namespace MinecraftMapEditor\Block;

class Simple extends \MinecraftMapEditor\Block
{
    /**
     * Get a simple block - one with no fancy settings.
     *
     * @param int $blockRef Block reference - one of the BlockRef class constants.
     *
     * @throws \Exception
     */
    public function __construct($blockRef)
    {
        // The 3rd value in the array shows if it's a simple block or not.
        // Here, we're only dealing with simple blocks.
        $block = IDs::$list[$blockRef];
        if (!isset($block[2])) {
            $this->setBlockID($block[0]);
            $this->setBlockData($block[1]);
        } else {
            $blockName = Ref::getNameFor($blockRef);
            if ($blockName !== false) {
                $exceptionMessage = 'Cannot declare block '.$blockName.' in Simple; use '.$block[2].' instead';
            } else {
                $exceptionMessage = 'Unknown block reference';
            }
            throw new \Exception($exceptionMessage, E_ERROR);
        }
    }
}
