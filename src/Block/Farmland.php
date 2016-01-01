<?php

namespace MME\Block;

class Farmland extends \MME\Block
{
    use Traits\BasicValue, Traits\Create;

    /**
     * Get a farmland block, with the given wetness.
     *
     * @param int $wetness 0-7
     *
     * @throws \Exception
     */
    public function __construct($wetness)
    {
        $this->setBlockIDFor(Ref::FARMLAND);
        $this->checkValue($wetness, 0, 7, 'Invalid wetness for farmland');
    }
}
