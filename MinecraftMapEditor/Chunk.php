<?php

namespace MinecraftMapEditor;

class Chunk
{
    /** @var \Nbt\Service NBT class for this chunk **/
    public $nbt;
    public $changed = false;

    /**
     * Initialise a chunk based on NBT data.
     *
     * @param string $nbtString The (raw) nbtString
     */
    public function __construct($nbtString)
    {
        if ($nbtString != null) {
            // The NBT class reads from files, so we write the nbtString to a
            // pointer to memory
            $stream = fopen('php://memory', 'r+b');
            fwrite($stream, $nbtString);
            rewind($stream);

            $this->nbt = new \Nbt\Service();
            $this->nbt->loadFile($stream, null);
            fclose($stream);
        }
    }

    /**
     * Get the NBT string for this chunk.
     *
     * @return string
     */
    public function getNBTstring()
    {
        // Again, the NBT class wants to write to a file, so set up a temporary
        // file so we can read it back in
        // I'd like to do this with php://memory, but not sure how to read
        // back to a string efficiently
        $tmpFile = tempnam('/tmp', 'minecraft-map-editor');
        $stream = fopen($tmpFile, 'wb');
        $this->nbt->writeFile($stream, null);
        fclose($stream);
        $nbtString = file_get_contents($tmpFile);
        unlink($tmpFile);

        return $nbtString;
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

        $sections = &$this->findTag($this->nbt->root, 'Sections');
        $section = &$this->getSection($sections, $chunkCoords->getSectionRef());

        // Get the block ID
        $blocks = &$this->findtag($section, 'Blocks');
        $blockRef = ($chunkCoords->y * 16 * 16) + ($chunkCoords->z * 16) + $chunkCoords->x;

        if ($block['blockID'] <= 255) {
            if ($blocks['value'][$blockRef] != $block['blockID']) {
                $blocks['value'][$blockRef] = $block['blockID'];
                $this->changed = true;
            }
        } else {
            // TODO: This bit
            // the 'ADD' record
            // needs to be considered if the 'ADD' record exists in the NBT data
            // at all, not just if this block ID is greater than 255
        }

        // set block data
        $blockData = &$this->findTag($section, 'Data');
        $this->setNibbleIn($blockData['value'], $blockRef, $block['blockData']);

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
        $sections = &$this->findTag($this->nbt->root, 'Sections');
        // Then get the correct section for these co-ordinates
        $section = $this->getSection($sections, $chunkCoords->getSectionRef());

        // Get the block ID
        $blocks = &$this->findtag($section, 'Blocks');
        $blockRef = ($chunkCoords->getSectionY() * 16 * 16) + ($chunkCoords->z * 16) + $chunkCoords->x;
        $blockID = $blocks['value'][$blockRef];

        // check if there's an Add field
        $add = &$this->findtag($section, 'Add');
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
        $blockData = &$this->findTag($section, 'Data');
        // Get the nibble for this block
        $thisBlockData = $this->getNibbleFrom($blockData['value'], $blockRef);

        return ['blockID' => $blockID, 'blockData' => $thisBlockData];
    }

    /**
     * Find a tag within a tree of NBT data.
     *
     * @param &array $data
     * @param string $tag
     *
     * @return &array|false
     */
    private function &findTag(&$data, $tag)
    {
        foreach ($data as &$d) {
            // Check if we've found the name
            if ($d['name'] == $tag) {
                return $d;
            }

            // For the given tag types, we can recurse further down the tree
            if (in_array($d['type'], [\Nbt\Service::TAG_COMPOUND, \Nbt\Service::TAG_LIST])) {
                return $this->findTag($d['value'], $tag);
            }
        }

        // Must return a reference...!
        $false = false;

        return $false;
    }

    /**
     * Get the correct section from within the Sections tag (based on Y index).
     *
     * @param &array $data
     * @param int    $yRef
     *
     * @return &array
     */
    private function &getSection(&$data, $yRef)
    {
        foreach ($data['value']['value'] as &$subChunk) {
            $tag = $this->findTag($subChunk, 'Y');
            if ($tag['value'] == $yRef) {
                return $subChunk;
            }
        }
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
     * @param array $array
     * @param int   $blockRef
     * @param int   $value
     */
    private function setNibbleIn(&$array, $blockRef, $value)
    {
        $arrayRef = floor($blockRef / 2);
        // Get the current value, blocking out the value we want to copy in
        $curValue = $array[$arrayRef] & ($blockRef % 2 == 0 ? 0xF0 : 0x0F);
        // Add the nibble we want to the correct side of the byte
        $newValue = $curValue & ($blockRef % 2 == 0 ? $value : ($value << 4));
        // and set the value in the array
        $array[$arrayRef] = $newValue;
    }
}
