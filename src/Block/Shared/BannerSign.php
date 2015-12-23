<?php

namespace MinecraftMapEditor\Block\Shared;

abstract class BannerSign extends \MinecraftMapEditor\Block
{
    use Create;

    const SOUTH          = 00;
    const SOUTHSOUTHWEST = 01;
    const SOUTHWEST      = 02;
    const WESTSOUTHWEST  = 03;
    const WEST           = 04;
    const WESTNORTHWEST  = 05;
    const NORTHWEST      = 06;
    const NORTHNORTHWEST = 07;
    const NORTH          = 08;
    const NORTHNORTHEAST = 09;
    const NORTHEAST      = 10;
    const EASTNORTHEAST  = 11;
    const EAST           = 12;
    const EASTSOUTHEAST  = 13;
    const SOUTHEAST      = 14;
    const SOUTHSOUTHEAST = 15;

    /**
     * Get a banner, with the given orientation.
     *
     * @param int $blockRef    One of the BANNER_ blockRefs
     * @param int $orientation Orientation of the banner; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $orientation, $standingBlock, $wallBlock, $entityData)
    {
        // We still call checkBlock to throw an exception if required
        // and to get the block information
        $block = $this->checkBlock($blockRef, [$standingBlock, $wallBlock]);

        switch ($blockRef) {
            case $standingBlock:
                $this->checkStanding($orientation);
                break;
            case $wallBlock:
                $this->checkWall($orientation);
                break;
        }

        parent::__construct($block[0], $orientation, $entityData);
    }

    /**
     * Check the orientation is valid for the standing banner.
     *
     * @param int $orientation
     */
    protected function checkStanding(&$orientation)
    {
        $this->checkDataRefValidAll($orientation, 'Invalid orientation for standing item');
    }

    /**
     * Check the orientation is valid for the wall banner.
     * Change the orientation setting as appropriate.
     *
     * @param int $orientation
     */
    protected function checkWall(&$orientation)
    {
        switch ($orientation) {
            case self::NORTH:
                $orientation = 2;

                return;
            case self::SOUTH:
                $orientation = 3;

                return;
            case self::WEST:
                $orientation = 4;

                return;
            case self::EAST:
                $orientation = 5;

                return;
            default:
                throw new \Exception('Invalid orientation for wall item');
        }
    }
}
