<?php

namespace MME\Coords;

/**
 * A ZX reference for actual co-ordinates, used in Height Maps and such.
 */
class FlatCoordRef extends RefCoords
{
    /**
     * Get the ZX value for this reference.
     *
     * @return int
     */
    public function getZX()
    {
        return ($this->z * 16) + $this->x;
    }

    /**
     * Get a reference based on a ZX value.
     *
     * @param int $zxVal
     *
     * @return \static
     */
    public static function fromZXval($zxVal)
    {
        return new static(floor($zxVal / 16), $zxVal % 16);
    }
}
