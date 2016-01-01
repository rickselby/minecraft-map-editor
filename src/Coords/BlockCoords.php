<?php

namespace MME\Coords;

class BlockCoords extends XYZCoords
{
    /**
     * Calculate which region file these co-ordinates are in.
     *
     * @return \MME\Coords\RegionRef
     */
    public function toRegionRef()
    {
        return new RegionRef(
            floor($this->x / (16 * 32)),
            floor($this->z / (16 * 32))
        );
    }

    /**
     * Calculate which chunk within a region file these co-ordinates are in
     * Each region has 32x32 chunks.
     *
     * @return \MME\Coords\ChunkRef
     */
    public function toChunkRef()
    {
        return new ChunkRef(
            $this->positiveModulus(floor($this->x / 16), 32),
            $this->positiveModulus(floor($this->z / 16), 32)
        );
    }

    /**
     * Convert the block co-ordinates to co-ordinates within a chunk.
     *
     * @return \MME\Coords\ChunkCoords
     */
    public function toChunkCoords()
    {
        return new ChunkCoords(
            $this->positiveModulus($this->x, 16),
            $this->y,
            $this->positiveModulus($this->z, 16)
        );
    }

    /**
     * Get the positive modulus of a number
     * e.g. -1 % 16 returns -1, but should return 15;
     * so add the base on again if it's negative.
     *
     * @param int $val
     * @param int $base
     *
     * @return int
     */
    private function positiveModulus($val, $base)
    {
        return $val % $base + ($val < 0 ? $base : 0);
    }
}
