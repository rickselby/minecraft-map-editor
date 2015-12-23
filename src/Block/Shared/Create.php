<?php

namespace MinecraftMapEditor\Block\Shared;

use MinecraftMapEditor\Block\IDs;

trait Create
{
    use \ConstHelpers\Validating;

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
    protected function checkBlock($blockRef, $list)
    {
        $this->checkInList($blockRef, $list, 'Incorrect block type requested');

        return IDs::$list[$blockRef];
    }

    /**
     * Check if the given value is in any of the class constants.
     *
     * @param int    $ref   Data reference (from Block\DataRef)
     * @param string $error Error string for exception if $ref is invalid
     *
     * @return true
     *
     * @throws Exception
     */
    protected function checkDataRefValidAll($ref, $error)
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
    protected function checkDataRefValidStartWith($ref, $constStart, $error)
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
    protected function checkInList($item, $list, $errorMsg)
    {
        if (!in_array($item, $list)) {
            throw new \Exception($errorMsg, E_ERROR);
        }

        return true;
    }
}
