<?php

namespace MME\Helper;

use MME\World;
use MME\Coords\BlockCoords;
use MME\Coords\BlockCoordsRange;

class Place
{
    const DIR_NORTH = 1; // -z
    const DIR_EAST = 2;  // +x
    const DIR_SOUTH = 3; // +z
    const DIR_WEST = 4;  // -x

    /**
     * Place a list of blocks in a line, starting at the given coordinate, in the
     * given direction.
     *
     * @param World        $world     The world to work with
     * @param BlockCoords  $coords    The co-ordinates to start at
     * @param int          $direction The direction to place in
     * @param \MME\Block[] $list      The list of blocks to place
     */
    public static function line(World &$world, BlockCoords $coords, $direction, $list)
    {
        $range = BlockCoordsRange::fromBlockCoords($coords);

        self::setRange($range, $direction, count($list));

        foreach ($range->iterate() as $blockCoords) {
            $block = array_shift($list);

            $world->setBlock($blockCoords, $block);
        }
    }

    /**
     * Place many lines of blocks.
     *
     * @param World       $world              The world to work with
     * @param BlockCoords $coords             The co-ordinates to start at
     * @param int         $primaryDirection   The direction each line is placed in
     * @param int         $secondaryDirection The direction to go for each subsequent line
     * @param array[]     $lists              An array of lists of blocks
     */
    public static function lines(World &$world, BlockCoords $coords,
        $primaryDirection, $secondaryDirection, $lists)
    {
        self::checkDirections($primaryDirection, $secondaryDirection);

        $range = BlockCoordsRange::fromBlockCoords($coords);
        self::setRange($range, $secondaryDirection, count($lists));

        foreach ($range->iterate() as $lineStartCoords) {
            $line = array_shift($lists);
            self::line($world, $lineStartCoords, $primaryDirection, $line);
        }
    }

    /**
     * Set a range given a direction and a size.
     *
     * @param type $range     Range to set up
     * @param type $direction Direction to add range to
     * @param type $size      Range size
     */
    private static function setRange(&$range, $direction, $size)
    {
        switch ($direction) {
            case self::DIR_NORTH:
                $range->zRange(-$size);
                break;
            case self::DIR_EAST:
                $range->xRange($size);
                break;
            case self::DIR_SOUTH:
                $range->zRange($size);
                break;
            case self::DIR_WEST:
                $range->xRange(-$size);
                break;
        }
    }

    /**
     * Check primary and secondary directions are at 90 degrees to each other.
     *
     * @param int $primary
     * @param int $secondary
     *
     * @throws \Exception
     */
    private static function checkDirections($primary, $secondary)
    {
        $validSecondary = [];
        switch ($primary) {
            case self::DIR_NORTH:
            case self::DIR_SOUTH:
                $validSecondary = [self::DIR_EAST, self::DIR_WEST];
                break;
            case self::DIR_EAST:
            case self::DIR_WEST:
                $validSecondary = [self::DIR_NORTH, self::DIR_SOUTH];
                break;
        }
        if (!in_array($secondary, $validSecondary)) {
            throw new \Exception('Invalid directions');
        }
    }
}
