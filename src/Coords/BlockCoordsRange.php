<?php

namespace MME\Coords;

class BlockCoordsRange extends BlockCoords
{
    private $xRange = 1;
    private $yRange = 1;
    private $zRange = 1;

    /**
     * Set the x range to iterate over
     * @param int $range
     * @return self
     */
    public function xRange($range)
    {
        $this->xRange = $range;

        return $this;
    }

    /**
     * Set the y range to iterate over
     * @param int $range
     * @return self
     */
    public function yRange($range)
    {
        $this->yRange = $range;

        return $this;
    }

    /**
     * Set the z range to iterate over
     * @param int $range
     * @return self
     */
    public function zRange($range)
    {
        $this->zRange = $range;

        return $this;
    }

    /**
     * Iterate over the given range
     */
    public function iterate()
    {
        for($x = $this->x; $x < ($this->x + $this->xRange); ($this->xRange > 0 ? $x++ : $x--)) {
            for($y = $this->y; $y < ($this->y + $this->yRange); ($this->yRange > 0 ? $y++ : $y--)) {
                for($z = $this->z; $z < ($this->z + $this->zRange); ($this->zRange > 0 ? $z++ : $z--)) {
                    yield new BlockCoords($x, $y, $z);
                }
            }
        }
    }

}
