<?php

namespace MinecraftMapEditor\Block;

class BrewingStand extends \MinecraftMapEditor\Block
{
    /**
     * Get a brewing stand with the given bottles in place.
     *
     * @param ? $eastBottle
     * @param ? $southWestBottle
     * @param ? $northWestBottle
     */
    public function __construct($eastBottle, $southWestBottle, $northWestBottle)
    {
        $data = 0x0;
        if ($eastBottle) {
            $data |= 0b001;
        }
        if ($southWestBottle) {
            $data |= 0b010;
        }
        if ($northWestBottle) {
            $data |= 0b100;
        }

        $block = IDs::$list[Ref::BREWING_STAND];

        parent::__construct($block[0], $data);
    }
}
