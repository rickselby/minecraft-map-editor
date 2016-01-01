<?php

namespace MME\Block;

class Cactus extends \MME\Block
{
    use Traits\BasicValue, Traits\Create;

    /**
     * Get a cactus with a given age. When the age is 15, it'll grow a new cactus
     * block on top of it (if the total height doesn't exceed 3).
     *
     * @param int $age Age of the cactus
     *
     * @throws \Exception
     */
    public function __construct($age)
    {
        $this->setBlockIDFor(Ref::CACTUS);
        $this->checkValue($age, 0, 15, 'Invalid age for cactus');
    }
}
