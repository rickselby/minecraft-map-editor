<?php

namespace MinecraftMapEditor;

class Chunk
{
    /** @var \Nbt\Node NBT tree for this chunk **/
    public $nbtNode;

    /** @var bool Flag if the chunk has been changed **/
    public $changed = false;

    /** @var nbt

    /**
     * Initialise a chunk based on NBT data.
     *
     * @param string $nbtString The (raw) nbtString
     */
    public function __construct($nbtString)
    {
        if ($nbtString != null) {
            $this->nbtNode = (new \Nbt\Service())->readString($nbtString);
        }
    }

    /**
     * Get the NBT string for this chunk.
     *
     * @return string
     */
    public function getNBTstring()
    {
        return (new \Nbt\Service())->writeString($this->nbtNode);
    }

    /**
     * Set a block in the world. Will overwrite a block if one exists at the co-ordinates.
     *
     * @param Coords\BlockCoords $coords Co-ordinates of the block
     * @param array              $block  Information about the new block
     */
    public function setBlock($coords, $block)
    {
        $chunkCoords = $coords->toChunkCoords();

        $sections = $this->findTag($this->nbtNode, 'Sections');
        $section = $this->getSection($sections, $chunkCoords->getSectionRef());

        // Get the block ID
        $blocks = $this->findTag($section, 'Blocks');
        $blockRef = ($chunkCoords->getSectionY() * 16 * 16) + ($chunkCoords->z * 16) + $chunkCoords->x;

        $blockIDList = $blocks->getValue();
        if ($block['blockID'] <= 255) {
            if ($blockIDList[$blockRef] != $block['blockID']) {
                $blockIDList[$blockRef] = $block['blockID'];
                $this->changed = true;
                $blocks->setValue($blockIDList);
            }
        } else {
            // No vanilla blocks above ID 255 yet (10th October 2015, 1.9 snapshots)
            trigger_error('Block ID larger than 255 requested. This is not supported yet.', E_ERROR);
        }

        // set block data
        $blockData = $this->findTag($section, 'Data');
        $this->setNibbleIn($blockData, $blockRef, $block['blockData']);
    }

    /**
     * Get information about a block.
     *
     * @param Coords\BlockCoords $coords
     *
     * @return array
     */
    public function getBlock($coords)
    {
        // Get the coordinates within this chunk (0-15 on x & z)
        $chunkCoords = $coords->toChunkCoords();

        // Get the 'Sections' tag from the NBT data
        $sections = $this->findTag($this->nbtNode, 'Sections');
        // Then get the correct section for these co-ordinates
        $section = $this->getSection($sections, $chunkCoords->getSectionRef());

        // Get the block ID
        $blocks = $this->findtag($section, 'Blocks');
        $blockRef = ($chunkCoords->getSectionY() * 16 * 16) + ($chunkCoords->z * 16) + $chunkCoords->x;
        $blockID = $blocks->getValue()[$blockRef];

        // check if there's an Add field
        $add = $this->findtag($section, 'Add');
        if ($add !== false) {
            // No vanilla blocks above ID 255 yet (10th October 2015, 1.9 snapshots)
            trigger_error('This chunk has block IDs above 255. This is not supported yet.', E_ERROR);
        }

        // Block Data
        // Get the block data from within the section
        $blockData = $this->findTag($section, 'Data');
        // Get the nibble for this block
        $thisBlockData = $this->getNibbleFrom($blockData->getValue(), $blockRef);

        return ['blockID' => $blockID, 'blockData' => $thisBlockData];
    }

    /**
     * Find a tag within a tree of NBT data.
     *
     * @param \Nbt\Node $node
     * @param string    $tag
     *
     * @return \Nbt\Node|false
     */
    private function findTag($node, $tag)
    {
        if ($node->getName() == $tag) {
            return $node;
        }

        // A list of Compound tags has no data associated with it...
        // so just check for children.
        if (!$node->isLeaf()) {
            foreach ($node->getChildren() as $childNode) {
                $node = $this->findTag($childNode, $tag);
                if ($node) {
                    return $node;
                }
            }
        }

        return false;
    }

    /**
     * Get the correct section from within the Sections tag (based on Y index).
     *
     * @param \Nbt\Node $node
     * @param int       $yRef
     *
     * @return \Nbt\Node
     */
    private function getSection($node, $yRef)
    {
        foreach ($node->getChildren() as $childNode) {
            $yNode = $this->findTag($childNode, 'Y');
            if ($yNode->getValue() == $yRef) {
                return $childNode;
            }
        }

        // If we didn't find one, we must create one

        // Doesn't need a name, it's part of a list
        $newY = \Nbt\Tag::tagCompound('', [
            \Nbt\Tag::tagByte('Y', $yRef),
            \Nbt\Tag::tagByteArray('Blocks',     array_fill(0, 4096, 0x0)),
            \Nbt\Tag::tagByteArray('Data',       array_fill(0, 2048, 0x0)),
            \Nbt\Tag::tagByteArray('BlockLight', array_fill(0, 2048, 0x0)),
            \Nbt\Tag::tagByteArray('SkyLight',   array_fill(0, 2048, 0x0)),
        ]);

        // Add it to the list
        $node->addChild($newY);

        return $newY;
    }

    /**
     * Get a nibble from an array of bytes.
     *
     * @param array $array
     * @param int   $blockRef
     *
     * @return binary (?)
     */
    private function getNibbleFrom($array, $blockRef)
    {
        $arrayRef = floor($blockRef / 2);

        return $blockRef % 2 == 0
            ? $array[$arrayRef] & 0x0F
            : ($array[$arrayRef] >> 4) & 0x0F; // the & 0x0F should be redundant?
    }

    /**
     * Set a nibble in an array to the given value.
     *
     * @param \Nbt\Node $node
     * @param int       $blockRef
     * @param int       $value
     */
    private function setNibbleIn($node, $blockRef, $value)
    {
        $array = $node->getValue();

        $arrayRef = floor($blockRef / 2);
        // Get the current value, blocking out the value we want to copy in
        $curValue = $array[$arrayRef] & ($blockRef % 2 == 0 ? 0xF0 : 0x0F);
        // Add the nibble we want to the correct side of the byte
        $newValue = $curValue | ($blockRef % 2 == 0 ? $value : ($value << 4));
        // and set the value in the array
        $array[$arrayRef] = $newValue;

        $node->setValue($array);
    }
}
