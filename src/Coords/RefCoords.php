<?php

namespace MME\Coords;

abstract class RefCoords
{
    /** @var int $x X co-ordinate */
    public $x;
    /** @var int $z Z co-ordinate */
    public $z;

    /**
     * Set up the co-ordinate reference.
     *
     * @param int $x
     * @param int $z
     */
    public function __construct($x, $z)
    {
        $this->x = $x;
        $this->z = $z;
    }

    /**
     * Return a key format for this reference.
     *
     * @return string
     */
    public function toKey()
    {
        return $this->x.'-'.$this->z;
    }

    /**
     * Generator to give a list of chunks, in the correct order.
     */
    public static function zxList($amount)
    {
        for ($z = 0; $z < $amount; ++$z) {
            for ($x = 0; $x < $amount; ++$x) {
                yield new static($x, $z);
            }
        }
    }
}
