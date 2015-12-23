<?php

namespace MinecraftMapEditor\Block;

class Leaves extends \MinecraftMapEditor\Block
{
    const NO_DECAY = 0b0000;
    const DECAY    = 0b0100;

    /**
     * Get leaves with decay settings.
     *
     * @param int  $blockRef Block reference from Block\Ref
     * @param bool $decay    [optional] Should the leaves decay?
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $decay = self::NO_DECAY)
    {
        $block = $this->checkBlock($blockRef, [
            Ref::LEAVES_ACACIA,
            Ref::LEAVES_BIRCH,
            Ref::LEAVES_DARK_OAK,
            Ref::LEAVES_JUNGLE,
            Ref::LEAVES_OAK,
            Ref::LEAVES_SPRUCE,
        ]);

        $this->checkInList($decay, [self::NO_DECAY, self::DECAY], 'Invalid decay setting for leaves');

        parent::__construct($block[0], $block[1] | $decay);
    }
}
