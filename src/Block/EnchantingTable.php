<?php

namespace MME\Block;

class EnchantingTable extends \MME\Block
{
    use Traits\Create, Traits\EntityData;

    /**
     * Get an enchanting table
     */
    public function __construct()
    {
        $this->setBlockIDAndDataFor(Ref::ENCHANTMENT_TABLE);
        $this->initEntityData('EnchantTable');
    }
}
