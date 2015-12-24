<?php

namespace MinecraftMapEditor\Block;

class BrewingStand extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    /**
     * Get a brewing stand with the given bottles in place.
     *
     * @param ? $eastBottle
     * @param ? $southWestBottle
     * @param ? $northWestBottle
     */
    public function __construct($eastBottle, $southWestBottle, $northWestBottle)
    {
        $this->setBlockIDFor(Ref::BREWING_STAND);

        $data = 0;
        if ($eastBottle) {
            $data |= 0b0001;
        }
        if ($southWestBottle) {
            $data |= 0b0010;
        }
        if ($northWestBottle) {
            $data |= 0b0100;
        }

        $this->setBlockData($data);
    }
}
