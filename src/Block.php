<?php

namespace MME;

/**
 * NB. Some 2-block items need some clever way of helping put them into the world:
 *  - Beds
 *  - Tall Flowers
 *  - Extended Pistons.
 */
class Block
{
    /** @var int Block ID - a single byte **/
    public $id;

    /** @var int Block Data - a nibble **/
    public $data = 0;

    /** @var \Nbt\Node|null Block Entity - an NBT Compound Tag, if it exists **/
    public $entityData = null;

    /** @var int Local block reference **/
    public $ref;

    public function setBlockID($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setBlockData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function setEntityData($entityData)
    {
        $this->entityData = $entityData;

        return $this;
    }

    public function setBlockRef($blockRef)
    {
        $this->ref = $blockRef;
    }
}
