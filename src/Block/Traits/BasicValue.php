<?php

namespace MME\Block\Traits;

trait BasicValue
{
    use CheckValue {
        CheckValue::checkValue AS verifyValue;
    }

    /**
     * Get a block with a basic value for the block data.
     *
     * @param int    $value            Value for block data
     * @param int    $min              Minimum value of the value
     * @param int    $max              Maximum value of the value
     * @param string $exceptionMessage Error message if value is invalid
     *
     * @throws \Exception
     */
    public function checkValue($value, $min, $max, $exceptionMessage)
    {
        $this->verifyValue($value, $min, $max, $exceptionMessage);

        $this->setBlockData($value);
    }
}
