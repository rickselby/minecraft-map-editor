<?php

namespace MinecraftMapEditor\Block\Shared;

use MinecraftMapEditor\Block\IDs;

abstract class BasicValue extends \MinecraftMapEditor\Block
{
    /**
     * Get a block with a basic value for the block data.
     *
     * @param int    $blockRef         Block to use
     * @param int    $value            Value for block data
     * @param int    $min              Minimum value of the value
     * @param int    $max              Maximum value of the value
     * @param string $exceptionMessage Error message if value is invalid
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $value, $min, $max, $exceptionMessage)
    {
        if ($value < $min || $value > $max) {
            throw new \Exception($exceptionMessage, E_ERROR);
        }

        $block = IDs::$list[$blockRef];

        parent::__construct($block[0], $value);
    }
}
