<?php

namespace MinecraftMapEditor\Block;

class NetherWart extends \MinecraftMapEditor\Block
{
    /**
     * Get Nether Wart at the given stage of growth.
     *
     * @param type $stage
     *
     * @throws \Exception
     */
    public function __construct($stage)
    {
        if ($stage < 0 || $stage > 3) {
            throw new \Exception('Invalid stage for nether wart');
        }

        $block = IDs::$list[Ref::NETHER_WART];

        parent::__construct($block[0], $stage);
    }
}
