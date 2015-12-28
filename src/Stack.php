<?php

namespace MinecraftMapEditor;

/**
 * This is an early implementation of a stack of items, that will just set
 * block data.
 *
 * Supports method chaining.
 *
 * There's much more to be implemented, details at:
 * http://minecraft.gamepedia.com/Player.dat_format
 */
class Stack
{
    #    use Nbt\Helpers;

    /** @var \Nbt\Node **/
    public $node;

    /** @var \Nbt\Node **/
    protected $tag;

    /**
     * Set a name for the stack, if required.
     *
     * @param string $name
     */
    public function __construct($name = '')
    {
        $this->node = \Nbt\Tag::tagCompound($name, []);
    }

    /**
     * Set the number of items in the stack.
     *
     * @param int $count
     *
     * @return \MinecraftMapEditor\Stack
     */
    public function setCount($count)
    {
        $this->node->addChild(\Nbt\Tag::tagByte('Count', $count));

        return $this;
    }

    /**
     * Set block data for this stack.
     *
     * @param \MinecraftMapEditor\Block $block
     *
     * @return \MinecraftMapEditor\Stack
     */
    public function setBlock(Block $block)
    {
        // We need the name for the block, not the id...
        $this->node->addChild(\Nbt\Tag::tagString('id', Block\Names::$list[$block->ref]));
        $this->node->addChild(\Nbt\Tag::tagShort('Damage', $block->data));
        if ($block->entityData) {
            $this->addTag();
            $this->tag->addChild(\Nbt\Tag::tagCompound('BlockEntityData', $block->entityData->getChildren()));
        }

        return $this;
    }

    /**
     * Get a copy of this stack, set for a certain slot.
     * Allows a stack to be 'duplicated' across stacks without rebuilding.
     *
     * @param int $slot
     *
     * @return \MinecraftMapEditor\Stack
     */
    public function getForSlot($slot)
    {
        $forSlot = clone $this;
        $forSlot->node->addChild(\Nbt\Tag::tagByte('Slot', $slot));

        return $forSlot;
    }

    /**
     * Get multiple copies of this stack for certain slots.
     *
     * @param int[] $slots
     *
     * @return \MinecraftMapEditor\Stack[]
     */
    public function getForSlots($slots)
    {
        $stackList = [];
        foreach ($slots as $slot) {
            $x = clone $this;
            $x->node->addChild(\Nbt\Tag::tagByte('Slot', $slot));
            $stackList[] = $x;
            unset($x);
        }

        return $stackList;
    }

    /**
     * Add the 'tag' compount tag, if it doesn't already exist.
     */
    protected function addTag()
    {
        if (!isset($this->tag)) {
            $this->tag = \Nbt\Tag::tagCompound('tag', []);
            $this->node->addChild($this->tag);
        }
    }

    public function __clone()
    {
        if ($this->node !== null) {
            $this->node = clone $this->node;
        }
        if ($this->tag !== null) {
            $this->tag = clone $this->tag;
        }
    }
}
