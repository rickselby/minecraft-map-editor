<?php

namespace MME\Block;

class FlowerPot extends \MME\Block
{
    use Traits\Create, Traits\EntityData;

    /**
     * A flower pot, optionally containing a flower
     *
     * @param \MME\Block $contains The flower the block contains
     */
    public function __construct($contains = null)
    {
        // This is going to define the plant in the tile entity data
        // - which is to be done...

        $this->setBlockIDAndDataFor(Ref::FLOWER_POT);

        $this->initEntityData('FlowerPot');

        $this->entityData->addChild(\Nbt\Tag::tagString('Item', $contains ? Names::$list[$contains->ref] : ''));
        $this->entityData->addChild(\Nbt\Tag::tagInt('Data', $contains ? $contains->data : 0));
    }
}
