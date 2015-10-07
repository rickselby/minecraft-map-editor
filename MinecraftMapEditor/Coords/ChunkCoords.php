<?php

namespace MinecraftMapEditor\Coords;

class ChunkCoords extends XYZCoords
{
    /**
     * Get the reference for which section within the chunk these co-ordinates are in.
     *
     * @return int
     */
    public function getSectionRef()
    {
        return (int) floor($this->y / 16);
    }

    /**
     * Get the y co-ordinate within this section.
     *
     * @return int
     */
    public function getSectionY()
    {
        // y will never be negative so nothing clever required here
        return $this->y % 16;
    }
}
