<?php

namespace MME\Block;

class EndPortal extends \MME\Block
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
