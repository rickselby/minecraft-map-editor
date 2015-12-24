<?php

namespace MinecraftMapEditor\Block;

class NetherWart extends \MinecraftMapEditor\Block
{
    use Traits\BasicValue, Traits\Create;

    /**
     * Get Nether Wart at the given stage of growth.
     *
     * @param type $stage
     *
     * @throws \Exception
     */
    public function __construct($stage)
    {
        $this->setBlockIDFor(Ref::NETHER_WART);
        $this->checkValue($stage, 0, 3, 'Invalid stage for nether wart');
    }
}
