<?php

namespace MinecraftMapEditor\Block;

class Tripwire extends \MinecraftMapEditor\Block
{
    const INACTIVE = 0b0000;
    const ACTIVE   = 0b0001;

    const ON_BLOCK      = 0b0000;
    const SUSPENDED_AIR = 0b0010;

    const NO_VALID_CIRCUIT = 0b0000;
    const VALID_CIRCUIT    = 0b0100;

    const ARMED    = 0b0000;
    const DISARMED = 0b1000;

    /**
     * Get a piece of tripwire with the given settings.
     *
     * @param int $active    Tripwire::ACTIVE or Tripwire::INACTIVE
     *                       (entity colliding with it?)
     * @param int $suspended Tripwire::ON_BLOCK or Tripwire::SUSPENDED_AIR
     *                       (is above block or not?)
     * @param int $circuit   Tripwire::NO_VALID_CIRCUIT or Tripwire::VALID_CIRCUIT
     *                       (is part of valid tripwire circuit?)
     * @param int $armed     Tripwire::ARMED or Tripwire::DISARMED
     *                       (is the wire armed?)
     *
     * @throws \Exception
     */
    public function __construct($active, $suspended, $circuit, $armed)
    {
        $block = IDs::$list[Ref::TRIPWIRE];

        self::checkInList($active, [self::INACTIVE, self::ACTIVE], 'Invalid active setting for tripwire');
        self::checkInList($suspended, [self::ON_BLOCK, self::SUSPENDED_AIR], 'Invalid suspended setting for tripwire');
        self::checkInList($circuit, [self::NO_VALID_CIRCUIT, self::VALID_CIRCUIT], 'Invalid circuit setting for tripwire');
        self::checkInList($armed, [self::ARMED, self::DISARMED], 'Invalid armed setting for tripwire');

        parent::__construct($block[0], $active | $suspended | $circuit | $armed);
    }
}
