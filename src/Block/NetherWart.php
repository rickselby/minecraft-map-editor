<?php

namespace MinecraftMapEditor\Block;

class NetherWart extends \MinecraftMapEditor\Block\Shared\BasicValue
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
        parent::__construct(Ref::NETHER_WART, $stage, 0, 3, 'Invalid stage for nether wart');
    }
}
