<?php

namespace MME\Coords;

class BlockCoordsRange extends BlockCoords
{
    private $xRange = 0;
    private $yRange = 0;
    private $zRange = 0;

    /**
     * Convert a BlockCoords to a BlockCoordsRange.
     *
     * @param \MME\Coords\BlockCoords $coords
     *
     * @return \MME\Coords\BlockCoordsRange
     */
    public static function fromBlockCoords(BlockCoords $coords)
    {
        return new self($coords->x, $coords->y, $coords->z);
    }

    /**
     * Set the x range to iterate over.
     *
     * @param int $range
     *
     * @return self
     */
    public function xRange($range)
    {
        $this->xRange = $this->lessOne($range);

        return $this;
    }

    /**
     * Set the y range to iterate over.
     *
     * @param int $range
     *
     * @return self
     */
    public function yRange($range)
    {
        $this->yRange = $this->lessOne($range);

        return $this;
    }

    /**
     * Set the z range to iterate over.
     *
     * @param int $range
     *
     * @return self
     */
    public function zRange($range)
    {
        $this->zRange = $this->lessOne($range);

        return $this;
    }

    /**
     * Make the value one shorter; working on both positive and negative values.
     *
     * @param int $value
     *
     * @return int
     */
    private function lessOne($value)
    {
        if ($value > 0) {
            return $value - 1;
        } else {
            return $value + 1;
        }
    }

    /**
     * Iterate over the given range.
     */
    public function iterate()
    {
        foreach (range($this->x, $this->x + $this->xRange) as $x) {
            foreach (range($this->y, $this->y + $this->yRange) as $y) {
                foreach (range($this->z, $this->z + $this->zRange) as $z) {
                    yield new BlockCoords($x, $y, $z);
                }
            }
        }
    }
}
