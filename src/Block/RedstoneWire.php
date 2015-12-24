<?php

namespace MinecraftMapEditor\Block;

class RedstoneWire extends \MinecraftMapEditor\Block
{
    use Traits\BasicValue, Traits\Create;

    /**
     * Get redstone wire with the given power.
     *
     * @param int $power 0-15
     *
     * @throws \Exception
     */
    public function __construct($power)
    {
        $this->setBlockIDFor(Ref::REDSTONE_WIRE);
        $this->checkValue($power, 0, 15, 'Invalid power for redstone wire');
    }
}
