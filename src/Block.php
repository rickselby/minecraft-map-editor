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
     * @param type $id
     * @param type $data
     * @param type $entity
     */
    public function __construct($id, $data = 0x00, $entity = null)
    {
        $this->id = $id;
        $this->data = $data;
        $this->entity = $entity;
    }

    /**
     * Get a simple block - one with no fancy settings.
     *
     * @param int $blockRef Block reference - one of the BlockRef class constants.
     *
     * @return \self
     *
     * @throws Exception
     */
    public static function getBlock($blockRef)
    {
        // The 3rd value in the array shows if it's a simple block or not.
        // Here, we're only dealing with simple blocks.
        $block = Block\IDs::$list[$blockRef];
        if (!isset($block[2]) || !$block[2]) {
            return new self($block[0], $block[1]);
        } else {
            throw new Exception('Cannot declare a complex block in getBlock()', E_ERROR);
        }
    }

    /********************************************************************
     * Start definitions for complex blocks (with directions, sizes, etc)
     ********************************************************************/

    /**
     * Flowing water or lava. Set the level - 0x0 is the highest, to 0x7 the lowest.
     * If level is 0x8, then it's a full block that is falling and only spreads downwards.
     *
     * @param int $blockRef Block reference
     * @param int $level    Level of liquid
     *
     * @return \self
     *
     * @throws Exception
     */
    public static function getFlowingLiquid($blockRef, $level)
    {
        $block = self::checkBlock($blockRef, [
            Block\Ref::LAVA_FLOWING,
            Block\Ref::WATER_FLOWING,
        ]);

        return new self($block[0], $level);
    }

    /**
     * Get a block of wood, with the given orientation.
     *
     * @param int $blockRef    Block reference from Block\Ref
     * @param int $orientation Orientation of the wood, from Block\DataRef::WOOD_*
     *
     * @return \self
     *
     * @throws Exception
     */
    public static function getWood($blockRef, $orientation)
    {
        $block = self::checkBlock($blockRef, [
            Block\Ref::WOOD_ACACIA,
            Block\Ref::WOOD_BIRCH,
            Block\Ref::WOOD_DARK_OAK,
            Block\Ref::WOOD_JUNGLE,
            Block\Ref::WOOD_OAK,
            Block\Ref::WOOD_SPRUCE,
        ]);

        // Check the orientation is valid
        self::checkDataRef($orientation, 'WOOD_', 'Invalid orientation for wood');

        // Return the block
        return new self(
            $block[0],
            // Orientation is bits 3 & 4, so shift it
            $block[1] & ($orientation << 2)
        );
    }

    /**
     * Get leaves with decay settings.
     *
     * @param int  $blockRef Block reference from Block\Ref
     * @param bool $decay    [optional] Should the leaves decay?
     *
     * @return \self
     *
     * @throws Exception
     */
    public static function getLeaves($blockRef, $decay = true)
    {
        $block = self::checkBlock($blockRef, [
            Block\Ref::LEAVES_ACACIA,
            Block\Ref::LEAVES_BIRCH,
            Block\Ref::LEAVES_DARK_OAK,
            Block\Ref::LEAVES_JUNGLE,
            Block\Ref::LEAVES_OAK,
            Block\Ref::LEAVES_SPRUCE,
        ]);

        // Update the block data if we don't want to decay the leaves
        if (!$decay) {
            $block[1] &= 0x4;
        }

        return new self($block[0], $block[1]);
    }

    /**
     * Get a torch with a given attatchment.
     *
     * @param int $blockRef   Block reference from Block\Ref
     * @param int $attachment Attachment direction, from Block\DataRef::TORCH_*
     *
     * @return \self
     *
     * @throws Exception
     */
    public static function getTorch($blockRef, $attachment)
    {
        $block = self::checkBlock($blockRef, [
            Block\Ref::TORCH,
            Block\Ref::REDSTONE_TORCH_OFF,
            Block\Ref::REDSTONE_REPEATER_ON,
        ]);

        // Check the orientation is valid
        self::checkDataRef($attachment, 'TORCH_', 'Invalid attachment for torch');

        return new self($block[0], $attachment);
    }

    /**
     * Get a double slab block. Optionally set the block to use the top texture
     * on all sides.
     *
     * @param int  $blockRef   Block reference from Block\Ref
     * @param bool $topTexture [optional] Use the top texture on all sides?
     *
     * @return \self
     *
     * @throws Exception
     */
    public static function getDoubleSlab($blockRef, $topTexture = false)
    {
        $block = self::checkBlock($blockRef, [
            Block\Ref::DOUBLE_SLAB_BRICK,
            Block\Ref::DOUBLE_SLAB_COBBLESTONE,
            Block\Ref::DOUBLE_SLAB_NETHER_BRICK,
            Block\Ref::DOUBLE_SLAB_QUARTZ,
            Block\Ref::DOUBLE_SLAB_SANDSTONE,
            Block\Ref::DOUBLE_SLAB_SANDSTONE_RED,
            Block\Ref::DOUBLE_SLAB_STONE,
            Block\Ref::DOUBLE_SLAB_STONE_BRICK,
            Block\Ref::DOUBLE_SLAB_STONE_WOOD,
            Block\Ref::DOUBLE_SLAB_WOOD_ACACIA,
            Block\Ref::DOUBLE_SLAB_WOOD_BIRCH,
            Block\Ref::DOUBLE_SLAB_WOOD_DARK_OAK,
            Block\Ref::DOUBLE_SLAB_WOOD_JUNGLE,
            Block\Ref::DOUBLE_SLAB_WOOD_OAK,
            Block\Ref::DOUBLE_SLAB_WOOD_SPRUCE,
        ]);

        if ($topTexture) {
            $block[1] &= 0x08;
        }

        return new self($block[0], $block[1]);
    }

    /**
     * Get a slab, positioned either top or bottom of the block.
     *
     * @param int $blockRef Block reference from Block\Ref
     * @param int $position Position of slab, from Block\DataRef::SLAB_*
     *
     * @return \self
     *
     * @throws Exception
     */
    public static function getSlab($blockRef, $position)
    {
        $block = self::checkBlock($blockRef, [
            Block\Ref::SLAB_BRICK,
            Block\Ref::SLAB_COBBLESTONE,
            Block\Ref::SLAB_NETHER_BRICK,
            Block\Ref::SLAB_QUARTZ,
            Block\Ref::SLAB_SANDSTONE,
            Block\Ref::SLAB_SANDSTONE_RED,
            Block\Ref::SLAB_STONE,
            Block\Ref::SLAB_STONE_BRICK,
            Block\Ref::SLAB_STONE_WOOD,
            Block\Ref::SLAB_WOOD_ACACIA,
            Block\Ref::SLAB_WOOD_BIRCH,
            Block\Ref::SLAB_WOOD_DARK_OAK,
            Block\Ref::SLAB_WOOD_JUNGLE,
            Block\Ref::SLAB_WOOD_OAK,
            Block\Ref::SLAB_WOOD_SPRUCE,
        ]);

        // Check the orientation is valid
        self::checkDataRef($position, 'SLAB_', 'Invalid position for slab');

        return new self($block[0], $block[1] & $position);
    }

    /**
     * Get FIRE! Set the age; age 15 above a flammable block will never stop burning.
     *
     * @param int $age Age of the fire (0-15)
     *
     * @return \self
     *
     * @throws Exception
     */
    public static function getFire($age = 0)
    {
        if ($age < 0 || $age > 15) {
            $age = 0;
        }

        $block = Block\IDs::$list[Block\Ref::FIRE];

        return new self($block[0], $age);
    }

    /**
     * Get half a bed, given the direction (head facing) and which part.
     *
     * @param int $direction The direction the head of the bed is facing, from Block\DataRef::BED_DIRECTION_*
     * @param int $part      The part of the bed, from Block\DataRef::BED_PART_*
     *
     * @return \self
     *
     * @throws Exception
     */
    public static function getBed($direction, $part)
    {
        self::checkDataRef($direction, 'BED_DIRECTION_', 'Invalid direction for bed');
        self::checkDataRef($part, 'BED_PART_', 'Invalid part for bed');

        $block = Block\IDs::$list[Block\Ref::BED];

        return new self($block[0], $direction & $part);
    }

    /**
     * Get a retracted piston.
     *
     * @param int $blockRef  Which piston
     * @param int $direction The direction the piston head is pointing, from Block\DataRef::PISTON_DIRECTION_*
     *
     * @return \self
     *
     * @throws Exception
     */
    public static function getPiston($blockRef, $direction)
    {
        $block = self::checkBlock($blockRef, [
            Block\Ref::PISTON,
            Block\Ref::PISTON_STICKY,
        ]);

        self::checkDataRef($direction, 'PISTON_DIRECTION_', 'Invalid direction for piston');

        return new self($block[0], $direction);
    }

    public static function getStairs($blockRef, $direction, $wayUp)
    {
        $block = self::checkBlock($blockRef, Block\Ref::getStartsWith('STAIRS_'));

        # check direction is valid

        # then return the block...
    }

    /**********************************************************
     * Start helper functions for checking validity of the data
     **********************************************************/

    /**
     * Check if the given block reference is in the list of blocks.
     *
     * @param int   $blockRef Block reference (from Block\Ref)
     * @param int[] $list     Array of valid block references
     *
     * @return int[] Block information from Block\IDs
     *
     * @throws Exception
     */
    private static function checkBlock($blockRef, $list)
    {
        self::checkInList($blockRef, $list, 'Incorrect block type requested');

        return Block\IDs::$list[$blockRef];
    }

    /**
     * Check if the given value is in a list of data references.
     *
     * @param int    $ref        Data reference (from Block\DataRef)
     * @param string $constStart The start of the constant names
     * @param string $error      Error string for exception if $ref is invalid
     *
     * @return true
     *
     * @throws Exception
     */
    private static function checkDataRef($ref, $constStart, $error)
    {
        return self::checkInList(
            $ref,
            Block\DataRef::getStartsWith($constStart),
            $error
        );
    }

    /**
     * Check an item is in a list; throw an exception with the given message
     * if it's not.
     *
     * @param mixed   $item
     * @param mixed[] $list
     * @param string  $errorMsg
     *
     * @return true
     *
     * @throws Exception
     */
    private static function checkInList($item, $list, $errorMsg)
    {
        if (!in_array($item, $list)) {
            throw new Exception($errorMsg, E_ERROR);
        }

        return true;
    }
}
