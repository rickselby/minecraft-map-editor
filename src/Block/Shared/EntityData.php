<?php

namespace MinecraftMapEditor\Block\Shared;

use Nbt\Tag;

trait EntityData
{
    /**
     * Initialise entity data, if none passed in.
     *
     * @param \Nbt\Node|null &$entityData
     * @param string         $id          Tile Entity ID
     *
     * @return \Nbt\Node
     */
    protected function initEntityData(&$entityData, $id)
    {
        if ($entityData === null || get_class($entityData) !== \Nbt\Node::class) {
            $entityData = \Nbt\Tag::tagCompound('', []);
        }

        $this->updateChildOrCreate($entityData, 'id', Tag::TAG_STRING, $id);
    }

    /**
     * Update a child value; create the node if it doesn't exist.
     *
     * @param \Nbt\Node $parent
     * @param string    $childName
     * @param int       $childType
     * @param mixed     $childValue
     */
    protected function updateChildOrCreate(\Nbt\Node $parent, $childName, $childType, $childValue)
    {
        $child = $parent->findChildByName($childName);
        if ($child) {
            $child->setValue($childValue);
        } else {
            $child = (new \Nbt\Node())
                ->setType($childType)
                ->setName($childName)
                ->setValue($childValue);

            $parent->addChild($child);
        }
    }

    /**
     * Create a child if it doesn't exist; don't do anything if it does.
     *
     * @param \Nbt\Node $parent
     * @param string    $childName
     * @param int       $childType
     * @param mixed     $childValue
     */
    protected function createChildOnly(\Nbt\Node $parent, $childName, $childType, $childValue)
    {
        $child = $parent->findChildByName($childName);
        if (!$parent->findChildByName($childName)) {
            $child = (new \Nbt\Node())
                ->setType($childType)
                ->setName($childName)
                ->setValue($childValue);

            $parent->addChild($child);
        }
    }
}
