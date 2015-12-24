<?php

namespace MinecraftMapEditor\Block;

class EndPortal extends \MinecraftMapEditor\Block
{
    use Traits\Create, Traits\EntityData;

    /**
     * Get an end portal block.
     */
    public function __construct()
    {
        $this->setBlockIDAndDataFor(Ref::END_PORTAL);
        $this->initEntityData('Airportal');
    }
}
