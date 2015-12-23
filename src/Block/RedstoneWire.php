<?php

namespace MinecraftMapEditor\Block;

class RedstoneWire extends Shared\BasicValue
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
        parent::__construct(Ref::REDSTONE_WIRE, $power, 0, 15, 'Invalid power for redstone wire');
    }
}
