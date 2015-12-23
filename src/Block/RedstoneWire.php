<?php

namespace MinecraftMapEditor\Block;

class RedstoneWire extends \MinecraftMapEditor\Block
{
    /**
     * Get redstone wire with the given power.
     *
     * @param int $power 0-15
     *
     * @throws \Exception
     */
    public function __construct($power)
    {
        if ($power < 0 || $power > 15) {
            throw new \Exception('Invalid power for redstone wire');
        }

        $block = IDs::$list[Ref::REDSTONE_WIRE];

        parent::__construct($block[0], $power);
    }
}
