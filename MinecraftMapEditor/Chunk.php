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
            $this->nbtNode = (new \Nbt\Service)->readString($nbtString);
        }
    }

    /**
     * Get the NBT string for this chunk.
     *
     * @return string
     */
    public function getNBTstring()
    {
        return (new \Nbt\Service)->writeString($this->nbtNode);
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

        $blockIDList = $blocks->getKey('value');
        if ($block['blockID'] <= 255) {
            if ($blockIDList[$blockRef] != $block['blockID']) {
                $blockIDList[$blockRef] = $block['blockID'];
                $this->changed = true;
                $blocks->setKey('value', $blockIDList);
            }
        } else {
            // TODO: This bit
            // the 'ADD' record
            // needs to be considered if the 'ADD' record exists in the NBT data
            // at all, not just if this block ID is greater than 255
        }

        // set block data
        $blockData = $this->findTag($section, 'Data');
        $this->setNibbleIn($blockData, $blockRef, $block['blockData']);

        // TODO: update height map too
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
        $blockID = $blocks->getKey('value')[$blockRef];

        // check if there's an Add field
        $add = $this->findtag($section, 'Add');
        if ($add !== false) {
            // TODO: this bit
            // $thisAddData = $this->getNibbleFrom($add['value'], $blockRef);
            // now do something with this to the block ID?
            // probably bit shifting stuff
            // doesn't seem to be implemented at the moment (no block IDs above 255)
            // so no rush...
        }

        // Block Data
        // Get the block data from within the section
        $blockData = $this->findTag($section, 'Data');
        // Get the nibble for this block
        $thisBlockData = $this->getNibbleFrom($blockData->getKey('value'), $blockRef);

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
        if ($node->getKey('name') == $tag) {
            return $node;
        }
#        echo 'Not '.$node->getKey('name').PHP_EOL;

        // A list of Compound tags has no data associated with it...
        // so just check for children.
        if (!$node->isLeaf()) {
            foreach($node->getChildren() AS $childNode) {
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
     * @param \Nbt\Node $data
     * @param int    $yRef
     *
     * @return \Nbt\Node
     */
    private function getSection($node, $yRef)
    {
        foreach($node->getChildren() AS $childNode) {
            $yNode = $this->findTag($childNode, 'Y');
            if ($yNode->getKey('value') == $yRef)
            {
                return $childNode;
            }
        }

        // if we didn't find one, we need to make one...
        // because it'll be all air

        // yikes!

        // I think creation of NBT tags should be done elsewhere...
        // Like in the NBT class...

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
        $array = $node->getKey('value');

        $arrayRef = floor($blockRef / 2);
        // Get the current value, blocking out the value we want to copy in
        $curValue = $array[$arrayRef] & ($blockRef % 2 == 0 ? 0xF0 : 0x0F);
        // Add the nibble we want to the correct side of the byte
        $newValue = $curValue & ($blockRef % 2 == 0 ? $value : ($value << 4));
        // and set the value in the array
        $array[$arrayRef] = $newValue;

        $node->setKey('value', $array);
    }
}
