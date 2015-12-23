<?php

namespace MinecraftMapEditor;

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
    public $data;

    /** @var \Nbt\Node Block Entity - an NBT Compound Tag, if it exists **/
    public $entity;

    /**
     * Create a block to pass around.
     *
     * @param int            $id
     * @param int            $data
     * @param \Nbt\Node|null $entity
     */
    public function __construct($id, $data = 0x00, \Nbt\Node $entity = null)
    {
        $this->id = $id;
        $this->data = $data;
        $this->entity = $entity;
    }
}
