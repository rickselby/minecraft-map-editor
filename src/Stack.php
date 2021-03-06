<?php

namespace MME;

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

    public function setName($name)
    {
        $this->node->setName($name);
    }

    /**
     * Set the number of items in the stack.
     *
     * @param int $count
     *
     * @return \MME\Stack
     */
    public function setCount($count)
    {
        $this->node->addChild(\Nbt\Tag::tagByte('Count', $count));

        return $this;
    }

    /**
     * Set block data for this stack.
     *
     * @param \MME\Block $block
     *
     * @return \MME\Stack
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
     * Set options in the display properties compound tag.
     *
     * @param string $name  Name of the item
     * @param string $lore  List of strings to display as lore for the item
     * @param int    $color Color, for leather armour.
     */
    public function setDisplayProperties($name, $lore = '', $color = null)
    {
        $this->addTag();
        $display = \Nbt\Tag::tagCompound('display', []);
        if ($name) {
            $display->addChild(\Nbt\Tag::tagString('Name', $name));
        }
        if ($lore) {
            $loreTag = \Nbt\Tag::tagList('Lore', \Nbt\Tag::TAG_STRING, []);
            foreach ($lore as $line) {
                $loreTag->addChild(\Nbt\Tag::tagString('', $line));
            }
            $display->addChild($loreTag);
        }
        if ($color) {
            $display->addChild(\Nbt\Tag::tagInt('color', $color));
        }

        $this->tag->addChild($display);
    }

    /**
     * Get a copy of this stack, set for a certain slot.
     * Allows a stack to be 'duplicated' across stacks without rebuilding.
     *
     * @param int $slot
     *
     * @return \MME\Stack
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
     * @return \MME\Stack[]
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

    /**
     * Clone the object correctly.
     */
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
