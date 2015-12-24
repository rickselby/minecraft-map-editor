<?php

namespace MinecraftMapEditor\Block\Traits;

trait BasicValue
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
    public function checkValue($value, $min, $max, $exceptionMessage)
    {
        if ($value < $min || $value > $max) {
            throw new \Exception($exceptionMessage, E_ERROR);
        }

        $this->setBlockData($value);
    }
}
