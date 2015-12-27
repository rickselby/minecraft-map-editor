<?php

namespace MinecraftMapEditor\Block\Traits;

trait StandingWall
{
    use Create;

    /**
     * Get a banner or sign, with the given orientation.
     *
     * @param int $blockRef      A valid blockRef for this class
     * @param int $orientation   Orientation of the banner; one of the class constants
     * @param int $standingBlock The version of the block that is standing (changes the validation)
     * @param int $wallBlock     The version of the block that is the wall (changes the validation)
     *
     * @throws \Exception
     */
    protected function verifyStandingWall($blockRef, $orientation, $standingBlock, $wallBlock)
    {
        // We still call checkBlock to throw an exception if required
        // and to get the block information
        $this->checkBlock($blockRef, [$standingBlock, $wallBlock]);

        switch ($blockRef) {
            case $standingBlock:
                $this->checkStanding($orientation);
                break;
            case $wallBlock:
                $this->checkWall($orientation);
                break;
        }

        $this->setBlockIDFor($blockRef);
        $this->setBlockData($orientation);
    }

    /**
     * Check the orientation is valid for the standing banner.
     *
     * @param int $orientation
     */
    protected function checkStanding(&$orientation)
    {
        $this->checkDataRefValidStartsWith($orientation, 'ORIENT_', 'Invalid orientation for standing item');
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
            case self::ORIENT_NORTH:
                $orientation = 2;

                return;
            case self::ORIENT_SOUTH:
                $orientation = 3;

                return;
            case self::ORIENT_WEST:
                $orientation = 4;

                return;
            case self::ORIENT_EAST:
                $orientation = 5;

                return;
            default:
                throw new \Exception('Invalid orientation for wall item');
        }
    }
}
