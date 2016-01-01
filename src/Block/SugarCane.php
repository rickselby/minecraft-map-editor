<?php

namespace MME\Block;

class SugarCane extends \MME\Block
{
    use Traits\BasicValue, Traits\Create;

    /**
     * Get a sugar cane with a given age. When the age is 15, it'll grow a new
     * sugar cane block on top of it (if the total height doesn't exceed 3).
     *
     * @param int $age Age of the sugar cane
     *
     * @throws \Exception
     */
    public function __construct($age)
    {
        $this->setBlockIDFor(Ref::SUGAR_CANE);
        $this->checkValue($age, 0, 15, 'Invalid age for sugar cane');
    }
}
