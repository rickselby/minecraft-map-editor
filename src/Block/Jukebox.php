<?php

namespace MinecraftMapEditor\Block;

class Jukebox extends \MinecraftMapEditor\Block
{
    use Traits\Create, Traits\EntityData;

    /**
     * Get a jukebox, optionally with the given disc inserted.
     *
     * @param \MinecraftMapEditor\Stack|null $disc [optional] Stack, probably containing a single disc, but could be anything.
     */
    public function __construct($disc = null)
    {
        $this->setBlockIDFor(Ref::JUKEBOX);

        $this->setBlockData($disc ? 1 : 0);

        $this->initEntityData('RecordPlayer');

        if ($disc)
        {
            $disc->setName('RecordItem');
            $this->entityData->addChild($disc->node);
        }
    }
}
