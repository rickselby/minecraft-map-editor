<?php

namespace MinecraftMapEditor\Block;

class Banner extends \MinecraftMapEditor\Block
{
    const SOUTH          = 0x00;
    const SOUTHSOUTHWEST = 0x01;
    const SOUTHWEST      = 0x02;
    const WESTSOUTHWEST  = 0x03;
    const WEST           = 0x04;
    const WESTNORTHWEST  = 0x05;
    const NORTHWEST      = 0x06;
    const NORTHNORTHWEST = 0x07;
    const NORTH          = 0x08;
    const NORTHNORTHEAST = 0x09;
    const NORTHEAST      = 0x10;
    const EASTNORTHEAST  = 0x11;
    const EAST           = 0x12;
    const EASTSOUTHEAST  = 0x13;
    const SOUTHEAST      = 0x14;
    const SOUTHSOUTHEAST = 0x15;

    /**
     * Get a banner, with the given orientation.
     *
     * @param int $blockRef    One of the BANNER_ blockRefs
     * @param int $orientation Orientation of the banner; one of the class constants
     *
     * @throws Exception
     */
    public function __construct($blockRef, $orientation)
    {
        // We still call checkBlock to throw an exception if required
        // and to get the block information
        $block = self::checkBlock($blockRef, Ref::getStartsWith('BANNER_'));

        switch ($blockRef) {
            case Ref::BANNER_STANDING:
                $this->checkStanding($orientation);
                break;
            case Ref::BANNER_WALL:
                $this->checkWall($orientation);
                break;
        }

        parent::__construct($block[0], $orientation);
    }

    /**
     * Check the orientation is valid for the standing banner.
     *
     * @param int $orientation
     */
    private function checkStanding(&$orientation)
    {
        self::checkDataRefValid($orientation, 'Invalid orientation for standing banner');
    }

    /**
     * Check the orientation is valid for the wall banner.
     * Change the orientation setting as appropriate.
     *
     * @param int $orientation
     */
    private function checkWall(&$orientation)
    {
        switch ($orientation) {
            case self::NORTH:
                $orientation = 0x2;

                return;
            case self::SOUTH:
                $orientation = 0x3;

                return;
            case self::WEST:
                $orientation = 0x4;

                return;
            case self::EAST:
                $orientation = 0x5;

                return;
            default:
                throw new \Exception('Invalid orientation for wall banner');
        }
    }
}
