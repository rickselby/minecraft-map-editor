<?php

namespace MME\Block;

class PressurePlate extends \MME\Block implements Interfaces\ActiveBit1
{
    use Traits\Create;

    /**
     * Get the given pressure plate, active or not.
     *
     * @param int $blockRef The appropriate PRESSURE_PLATE_ reference
     * @param int $active   One of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $active = self::INACTIVE)
    {
        $this->checkBlock($blockRef, Ref::getStartsWith('PRESSURE_PLATE_'));

        $this->checkDataRefValidAll($active, 'Invalid active setting for pressure plate');

        $this->setBlockData($active);
    }
}
