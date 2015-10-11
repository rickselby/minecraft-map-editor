<?php

namespace MinecraftMapEditor;

class Chunk
{
    /** @var \Nbt\Node NBT tree for this chunk **/
    public $nbtNode;

    /** @var bool Flag if the chunk has been changed **/
    public $changed = false;

    /** @var \Nbt\Node Node for the sections tag **/
    private $sectionsTag;

    /** @var \Nbt\Node[] Array of nodes for each section within the sections tag **/
    private $sectionsList;

    /** @var Array[] Array of cached section information for each section **/
    private $sectionParts = [];

    /** @var Int[] Array of affected zx coords **/
    private $affected = [];

    /**
     * Initialise a chunk based on NBT data.
     *
     * @param string $nbtString The (raw) nbtString
     */
    public function __construct($nbtString)
    {
        if ($nbtString != null) {
            $this->nbtNode = (new \Nbt\Service())->readString($nbtString);#
            // Cache the sections tag so we don't need to look for it every time
            $this->sectionsTag = $this->nbtNode->findChildByName('Sections');
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
     * @param Coords\ChunkCoords $coords Co-ordinates of the block
     * @param array              $block  Information about the new block
     */
    public function setBlock($chunkCoords, $block)
    {
        $yRef = $chunkCoords->getSectionRef();

        // Get the block ID
        $blocks = $this->getSectionPart($yRef, 'Blocks');
        $blockRef = $chunkCoords->getSectionYZX();

        $blockIDList = $blocks->getValue();
        if ($block['blockID'] <= 255) {
            if ($blockIDList[$blockRef] != $block['blockID']) {
                $blockIDList[$blockRef] = $block['blockID'];
                $this->setChanged($chunkCoords);
                $blocks->setValue($blockIDList);
            }
        } else {
            // No vanilla blocks above ID 255 yet (10th October 2015, 1.9 snapshots)
            trigger_error('Block ID larger than 255 requested. This is not supported yet.', E_ERROR);
        }

        // set block data
        $blockData = $this->getSectionPart($yRef, 'Data');
        $this->setNibbleIn($blockData, $blockRef, $block['blockData']);
    }

    /**
     * Get information about a block.
     *
     * @param Coords\ChunkCoords $coords
     *
     * @return array
     */
    public function getBlock($chunkCoords)
    {
        // Get the correct section for these co-ordinates
        $yRef = $chunkCoords->getSectionRef();

        // Get the block ID
        $blocks = $this->getSectionPart($yRef, 'Blocks');
        $blockRef = $chunkCoords->getSectionYZX();
        $blockID = $blocks->getValue()[$blockRef];

        // check if there's an Add field
        $add = $this->getSectionPart($yRef, 'Add');
        if ($add !== false) {
            // No vanilla blocks above ID 255 yet (10th October 2015, 1.9 snapshots)
            trigger_error('This chunk has block IDs above 255. This is not supported yet.', E_ERROR);
        }

        // Block Data
        // Get the block data from within the section
        $blockData = $this->getSectionPart($yRef, 'Data');
        // Get the nibble for this block
        $thisBlockData = $this->getNibbleFrom($blockData->getValue(), $blockRef);

        return ['blockID' => $blockID, 'blockData' => $thisBlockData];
    }

    /**
     * Get a specific tag from a section (which is then cached).
     *
     * @param int    $yRef
     * @param string $name
     *
     * @return \Nbt\Node
     */
    private function getSectionPart($yRef, $name)
    {
        if (!isset($this->sectionParts[$yRef][$name])) {
            $this->sectionParts[$yRef][$name] =
                $this->getSection($yRef)->findChildByName($name);
        }

        return $this->sectionParts[$yRef][$name];
    }

    /**
     * Get the correct section from within the Sections tag (based on Y index).
     *
     * @param \Nbt\Node $node
     * @param int       $yRef
     *
     * @return \Nbt\Node
     */
    private function getSection($yRef)
    {
        if (isset($this->sectionsList[$yRef])) {
            return $this->sectionsList[$yRef];
        }

        foreach ($this->sectionsTag->getChildren() as $childNode) {
            if ($childNode->findChildByName('Y')->getValue() == $yRef) {
                $this->sectionsList[$yRef] = $childNode;

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
        $this->sectionsTag->addChild($newY);
        $this->sectionsList[$yRef] = $newY;

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
        // This function should check if it's changing anything, and call setChanged if it does

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

    /**
     * Do tasks required before saving
     */
    public function prepareForSaving()
    {
        // Set Lightpopulated to zero to force a lighting update
        $this->nbtNode->findChildByName('LightPopulated')->setValue(0x00);
        // Set the last update time
        $this->nbtNode->findChildByName('LastUpdate')->setValue(time());
        // Update the height map
        $this->updateHeightMap();
    }

    /**
     * Update the height map before saving.
     */
    private function updateHeightMap()
    {
        if (count($this->affected)) {
            // Get the keys for y sections, to work out the largest y value to work from
            $yRefs = [];
            foreach ($this->sectionsTag->getChildren() as $subSection) {
                $yRefs[] = $subSection->findChildByName('Y')->getValue();
            }

            // Get the current height map
            $heightMapTag = $this->nbtNode->findChildByName('HeightMap');
            $heightMapArray = $heightMapTag->getValue();

            // Step through each affected z-x pair
            foreach ($this->affected as $zxVal) {
                $zxRef = Coords\FlatCoordRef::fromZXval($zxVal);
                $heightMapArray[$zxVal] = 0;
                for ($y = (max($yRefs) * 16) + 15; $y >= 0; --$y) {
                    $block = $this->getBlock(new Coords\ChunkCoords($zxRef->x, $y, $zxRef->z));
                    if ($block['blockID'] != 0x00) {
                        $heightMapArray[$zxVal] = $y;
                        break;
                    }
                }
            }

            // Write the height map back
            $heightMapTag->setValue($heightMapArray);
        }
    }

    /**
     * Mark that this chunk has been changed, and record the ZX value of the block changed.
     *
     * @param Coords\ChunkCoords $coords
     */
    private function setChanged($coords)
    {
        $this->changed = true;

        // Set that this zx pair was changed, so we need to recalcuate the height map on it
        $this->affected[] = $coords->getZX();
        $this->affected = array_unique($this->affected);
    }
}
