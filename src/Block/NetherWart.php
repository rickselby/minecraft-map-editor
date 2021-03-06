<?php

namespace MME\Block;

class NetherWart extends \MME\Block
{
    use Traits\BasicValue, Traits\Create;

    /**
     * Get Nether Wart at the given stage of growth.
     *
     * @param int $stage Stage of growth; 0-3
     *
     * @throws \Exception
     */
    public function __construct($stage)
    {
        $this->setBlockIDFor(Ref::NETHER_WART);
        $this->checkValue($stage, 0, 3, 'Invalid stage for nether wart');
    }
}
