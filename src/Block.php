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
    use \ConstHelpers\Validating;

    /** @var int Block ID - a single byte **/
    public $id;

    /** @var int Block Data - a nibble **/
    public $data;

    /** @var \Nbt\Node Block Entity - an NBT Compound Tag, if it exists **/
    public $entity;

    /**
     * Create a block to pass around.
     *
     * @param int $id
     * @param int $data
     * @param \Nbt\Node|null $entity
     */
    public function __construct($id, $data = 0x00, \Nbt\Node $entity = null)
    {
        $this->id = $id;
        $this->data = $data;
        $this->entity = $entity;
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
    protected static function checkBlock($blockRef, $list)
    {
        self::checkInList($blockRef, $list, 'Incorrect block type requested');

        return Block\IDs::$list[$blockRef];
    }

    /**
     * Check if the given value is in any of the class constants
     *
     * @param int    $ref        Data reference (from Block\DataRef)
     * @param string $error      Error string for exception if $ref is invalid
     *
     * @return true
     *
     * @throws Exception
     */
    protected static function checkDataRefValidAll($ref, $error)
    {
        if (!self::isValid($ref)) {
            throw new \Exception($error, E_ERROR);
        }

        return true;
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
    protected static function checkDataRefValidStartWith($ref, $constStart, $error)
    {
        if (!self::isValidStartsWith($ref, $constStart)) {
            throw new \Exception($error, E_ERROR);
        }

        return true;
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
    protected static function checkInList($item, $list, $errorMsg)
    {
        if (!in_array($item, $list)) {
            throw new \Exception($errorMsg, E_ERROR);
        }

        return true;
    }
}
