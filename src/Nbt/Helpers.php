<?php

namespace MinecraftMapEditor\Nbt;

trait Helpers
{
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
        if (!$parent->findChildByName($childName)) {
            $child = (new \Nbt\Node())
                ->setType($childType)
                ->setName($childName)
                ->setValue($childValue);

            $parent->addChild($child);
        }
    }
}
