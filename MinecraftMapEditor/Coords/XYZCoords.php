<?php

namespace MinecraftMapEditor\Coords;

abstract class XYZCoords extends RefCoords
{
    /** @var int **/
    public $y;

    /**
     * Set up the co-ordinates.
     *
     * @param int $x
     * @param int $y
     * @param int $z
     */
    public function __construct($x, $y, $z)
    {
        parent::__construct($x, $z);
        $this->y = $y;
    }

    /**
     * Return a key format for this reference.
     *
     * @return string
     */
    public function toKey()
    {
        return $this->x.'-'.$this->y.'-'.$this->z;
    }
}
