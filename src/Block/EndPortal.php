<?php

namespace MinecraftMapEditor\Block;

class EndPortal extends \MinecraftMapEditor\Block
{
    use Shared\EntityData;

    /**
     * Get an end portal block.
     */
    public function __construct()
    {
        $block = IDs::$list[Ref::END_PORTAL];

        $entityData = null;
        $this->initEntityData($entityData, 'Airportal');

        parent::__construct($block[0], $block[1], $entityData);
    }
}
