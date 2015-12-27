<?php

namespace MinecraftMapEditor\Block\Traits;

use Nbt\Tag;

trait EntityData
{
    use \MinecraftMapEditor\Nbt\Helpers;

    /**
     * Initialise entity data, if none passed in.
     *
     * @param string         $id         Tile Entity ID
     * @param \Nbt\Node|null $entityData
     */
    protected function initEntityData($id, $entityData = null)
    {
        if ($entityData === null
            || get_class($entityData) !== \Nbt\Node::class
            || $entityData->getType() !== \Nbt\Tag::TAG_COMPOUND) {
            $entityData = \Nbt\Tag::tagCompound('', []);
        }

        $this->updateChildOrCreate($entityData, 'id', Tag::TAG_STRING, $id);

        $this->setEntityData($entityData);
    }
}
