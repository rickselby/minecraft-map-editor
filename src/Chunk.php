<?php

namespace MinecraftMapEditor;

class Chunk
{
    use Nbt\Helpers;

    /** @var \Nbt\Node NBT tree for this chunk **/
    public $nbtNode;

    /** @var bool Flag if the chunk has been changed **/
    public $changed = false;

    /** @var \Nbt\Node Node for the sections tag **/
    private $sectionsTag;

    /** @var \Nbt\Node Node for the block entities tag **/
    private $blockEntitiesTag;

    /** @var \Nbt\Node[] Array of nodes for each section within the sections tag **/
    private $sectionsList;

    /** @var Array[] Array of cached section information for each section **/
    private $sectionParts = [];

    /** @var Int[] Array of affected zx coords **/
    private $affected = [];

    /** @var \Nbt\Node[] Array of Block Entity Information, keyed on co-ordinates **/
    private $blockEntities = [];

    /** @var \Nbt\Service **/
    private $nbtService;

    /**
     * Initialise a chunk based on NBT data.
     *
     * @param string $nbtString The (raw) nbtString
     */
    public function __construct($nbtString)
    {
        $this->nbtService = new \Nbt\Service(new \Nbt\DataHandler());

        if ($nbtString !== null) {
            $this->nbtNode = $this->nbtService->readString($nbtString);
            // Cache the sections tag so we don't need to look for it every time
            $this->sectionsTag = $this->nbtNode->findChildByName('Sections');
            // Organise the block entities
            $this->blockEntitiesTag = $this->nbtNode->findChildByName('TileEntities');
            $this->readBlockEntities();
        }
    }

    /**
     * Read in the block entity data from the chunk.
     */
    public function readBlockEntities()
    {
        foreach ($this->blockEntitiesTag->getChildren() as $blockEntity) {
            // Pull the co-ordinates from the entry
            // These are absolute co-ordinates, not relative to the chunk
            $x = $blockEntity->findChildByName('x')->getValue();
            $y = $blockEntity->findChildByName('y')->getValue();
            $z = $blockEntity->findChildByName('z')->getValue();
            $coords = new Coords\BlockCoords($x, $y, $z);
            $this->blockEntities[$coords->toKey()] = $blockEntity;
        }
    }

    /**
     * Get the NBT string for this chunk.
     *
     * @return string
     */
    public function getNBTstring()
    {
        return $this->nbtService->writeString($this->nbtNode);
    }

    /**
     * Set a block in the world. Will overwrite a block if one exists at the co-ordinates.
     *
     * @param Coords\BlockCoords $blockCoords Co-ordinates of the block
     * @param Block              $block       Information about the new block
     */
    public function setBlock(Coords\BlockCoords $blockCoords, Block $block)
    {
        $chunkCoords = $blockCoords->toChunkCoords();
        $yRef = $chunkCoords->getSectionRef();

        // Get the block ID
        $blocks = $this->getSectionPart($yRef, 'Blocks');
        $blockRef = $chunkCoords->getSectionYZX();

        $blockIDList = $blocks->getValue();
        if ($block->id <= 255) {
            if ($blockIDList[$blockRef] != $block->id) {
                $blockIDList[$blockRef] = $block->id;
                $this->setChanged($blockCoords);
                $blocks->setValue($blockIDList);
            }
        } else {
            // No vanilla blocks above ID 255 yet (10th October 2015, 1.9 snapshots)
            trigger_error('Block ID larger than 255 requested. This is not supported yet.', E_ERROR);
        }

        // set block data
        $blockData = $this->getSectionPart($yRef, 'Data');
        $this->setNibbleIn($blockData, $blockCoords, $block->data);

        // set block entity data
        $this->updateBlockEntity($blockCoords, $block->entityData);
    }

    /**
     * Get information about a block.
     *
     * @param Coords\BlockCoords $blockCoords
     *
     * @return array
     */
    public function getBlock(Coords\BlockCoords $blockCoords)
    {
        $block = new Block();
        $chunkCoords = $blockCoords->toChunkCoords();

        // Get the block ID
        $block->setBlockID($this->getBlockID($chunkCoords));

        // Block Data
        // Get the nibble for this block
        $block->setBlockData($this->getNibbleFrom(
            $this->getSectionPart($chunkCoords->getSectionRef(), 'Data')->getValue(),
            $chunkCoords->getSectionYZX()
        ));

        // Block Entity
        $block->setEntityData(
            isset($this->blockEntities[$blockCoords->toKey()])
                ? $this->blockEntities[$blockCoords->toKey()]
                : null
        );

        return $block;
    }

    public function getBlockID(Coords\ChunkCoords $chunkCoords)
    {
        $yRef = $chunkCoords->getSectionRef();

        // check if there's an Add field
        $add = $this->getSectionPart($yRef, 'Add');
        if ($add !== false) {
            // No vanilla blocks above ID 255 yet (10th October 2015, 1.9 snapshots)
            trigger_error('This chunk has block IDs above 255. This is not supported yet.', E_ERROR);
        }

        return $this->getSectionPart($yRef, 'Blocks')->getValue()[$chunkCoords->getSectionYZX()];
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
     * @param int $yRef
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
                $this->prepareSection($childNode);
                $this->sectionsList[$yRef] = $childNode;

                return $childNode;
            }
        }

        // If we didn't find one, we must create one

        // Doesn't need a name, it's part of a list
        $newY = \Nbt\Tag::tagCompound('', [
            \Nbt\Tag::tagByte('Y', $yRef),
            \Nbt\Tag::tagByteArray('Blocks',     array_fill(0, 4096, 0)),
            \Nbt\Tag::tagByteArray('Data',       array_fill(0, 2048, 0)),
            \Nbt\Tag::tagByteArray('BlockLight', array_fill(0, 2048, 0)),
            \Nbt\Tag::tagByteArray('SkyLight',   array_fill(0, 2048, 0)),
        ]);

        // Add it to the list
        $this->sectionsTag->addChild($newY);
        $this->sectionsList[$yRef] = $newY;

        return $newY;
    }

    /**
     * Prepare a section node when first accessing it.
     *
     * @param \Nbt\Node $node
     */
    private function prepareSection(\Nbt\Node $node)
    {
        // Alter the block data to be unsigned bytes
        $this->signedToUnsignedByteValue(
            $node->findChildByName('Blocks')
        );
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
     * @param \Nbt\Node          $node
     * @param Coords\BlockCoords $blockCoords
     * @param int                $value
     */
    private function setNibbleIn(\Nbt\Node $node, Coords\BlockCoords $blockCoords, $value)
    {
        $blockRef = $blockCoords->toChunkCoords()->getSectionYZX();
        // This function should check if it's changing anything, and call setChanged if it does

        $array = $node->getValue();
        $arrayRef = floor($blockRef / 2);

        // Save the original value to check if anything changes
        $origValue = $array[$arrayRef];

        // Get the current value, blocking out the value we want to copy in
        $curValue = $array[$arrayRef] & ($blockRef % 2 == 0 ? 0xF0 : 0x0F);
        // Add the nibble we want to the correct side of the byte
        $newValue = $curValue | ($blockRef % 2 == 0 ? $value : ($value << 4));
        // and set the value in the array
        $array[$arrayRef] = $newValue;

        // Check if we've change anything
        if ($newValue !== $origValue) {
            $this->setChanged($blockCoords);
        }

        $node->setValue($array);
    }

    /**
     * Do tasks required before saving.
     */
    public function prepareForSaving()
    {
        // Set Lightpopulated to zero to force a lighting update
        $this->nbtNode->findChildByName('LightPopulated')->setValue(0);
        // Set the last update time
        $this->nbtNode->findChildByName('LastUpdate')->setValue(time());
        // Update the height map
        $this->updateHeightMap();
        // Write the block entities back to the NBT tree
        $this->saveBlockEntities();
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
                    $block = $this->getBlockID(new Coords\ChunkCoords($zxRef->x, $y, $zxRef->z));
                    if ($block != 0) {
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
     * @param Coords\BlockCoords $coords
     */
    private function setChanged(Coords\BlockCoords $coords)
    {
        $this->changed = true;

        // Set that this zx pair was changed, so we need to recalcuate the height map on it
        $this->affected[] = $coords->toChunkCoords()->getZX();
        $this->affected = array_unique($this->affected);
    }

    /**
     * Update the block entity list for this chunk.
     *
     * @param Coords\BlockCoords $blockCoords
     * @param \Nbt\Node|null     $blockEntity
     */
    public function updateBlockEntity(Coords\BlockCoords $blockCoords, $blockEntity)
    {
        if ($blockEntity === null) {
            if (isset($this->blockEntities[$blockCoords->toKey()])) {
                unset($this->blockEntities[$blockCoords->toKey()]);
                $this->setChanged($blockCoords);
            }
        } else {
            $this->setChanged($blockCoords);
            // Add the co-ordinates to the block entity
            $this->updateChildOrCreateInt($blockEntity, 'x', $blockCoords->x);
            $this->updateChildOrCreateInt($blockEntity, 'y', $blockCoords->y);
            $this->updateChildOrCreateInt($blockEntity, 'z', $blockCoords->z);

            $this->blockEntities[$blockCoords->toKey()] = $blockEntity;
        }
    }

    /**
     * Try to update a child value of a node; if it doesn't exist, create it.
     *
     * @param \Nbt\Node $parent
     * @param string    $childName
     * @param int       $newValue
     */
    private function updateChildOrCreateInt(\Nbt\Node $parent, $childName, $newValue)
    {
        $this->updateChildOrCreate($parent, $childName, \Nbt\Tag::TAG_INT, $newValue);
    }

    /**
     * Save the block entities back to the tree.
     */
    public function saveBlockEntities()
    {
        // Probably easiest to reset the whole thing
        $this->blockEntitiesTag->removeAllChildren();

        if (count($this->blockEntities) == 0) {
            // When empty, lists have a zero payload type
            $this->blockEntitiesTag->setPayloadType(0);
        } else {
            $this->blockEntitiesTag->setPayloadType(\Nbt\Tag::TAG_COMPOUND);
            foreach ($this->blockEntities as $blockEntity) {
                $this->blockEntitiesTag->addChild($blockEntity);
            }
        }
    }

    /**
     * Convert a signed value to an unsigned value.
     * The NBT spec calls for signed values, but some bytes should be unsigned,
     * so we need to fiddle them.
     *
     * @param \Nbt\Node $node
     */
    private function signedToUnsignedByteValue(\Nbt\Node $node)
    {
        $value = $node->getValue();
        if (is_array($value)) {
            array_walk($value, function (&$byte) {
                $byte = $this->signedToUnsigedByte($byte);
            });
            $node->setValue($value);
        } else {
            $node->setValue($this->signedToUnsigedByte($value));
        }
    }

    /**
     * Convert a signed byte to an unsigned byte.
     *
     * @param int $value
     *
     * @return int
     */
    private function signedToUnsigedByte($value)
    {
        return unpack('C', pack('c', $value))[1];
    }
}
