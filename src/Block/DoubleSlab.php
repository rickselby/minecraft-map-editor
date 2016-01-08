<?php

namespace MME\Block;

class DoubleSlab extends \MME\Block
{
    use Traits\Create;

    const TEXTURE_NORMAL = 0b0000;
    const TEXTURE_TOP = 0b1000;

    /**
     * Get a double slab block. Optionally set the block to use the top texture
     * on all sides.
     *
     * @param int  $blockRef   Block reference from Block\Ref
     * @param bool $topTexture [Optional] Use the top texture on all sides?
     *                         One of the TEXTURE_ class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $topTexture = self::TEXTURE_NORMAL)
    {
        $block = $this->checkBlock($blockRef, Ref::getStartsWith('DOUBLE_SLAB'));

        $this->checkDataRefValidStartsWith($topTexture, 'TEXTURE_', 'Invalid texture setting for double slab');

        $this->setBlockData($block[1] | $topTexture);
    }
}
