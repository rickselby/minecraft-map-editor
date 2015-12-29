<?php

namespace MinecraftMapEditor\Block;

class EnchantingTable extends \MinecraftMapEditor\Block
{
    use Traits\Create, Traits\EntityData;

    /**
     * Get an end portal block.
     */
    public function __construct()
    {
        $this->setBlockIDAndDataFor(Ref::ENCHANTMENT_TABLE);
        $this->initEntityData('EnchantTable');
    }
}
