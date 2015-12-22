<?php

namespace MinecraftMapEditor\Block;

class PressurePlate extends \MinecraftMapEditor\Block
{
    const INACTIVE = 0x0;
    const ACTIVE = 0x1;

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
        $block = self::checkBlock($blockRef, Ref::getStartsWith('PRESSURE_PLATE_'));

        self::checkDataRefValidAll($active, 'Invalid active setting for pressure plate');

        parent::__construct($block[0], $active);
    }
}
