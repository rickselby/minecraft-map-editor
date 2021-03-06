<?php

namespace MME\Block;

class Tripwire extends \MME\Block implements Interfaces\ActiveBit1
{
    use Traits\Create;

    const ON_BLOCK = 0b0000;
    const SUSPENDED_AIR = 0b0010;

    const NO_VALID_CIRCUIT = 0b0000;
    const VALID_CIRCUIT = 0b0100;

    const ARMED = 0b0000;
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
        $this->setBlockIDFor(Ref::TRIPWIRE);

        $this->checkInList($active, [self::INACTIVE, self::ACTIVE], 'Invalid active setting for tripwire');
        $this->checkInList($suspended, [self::ON_BLOCK, self::SUSPENDED_AIR], 'Invalid suspended setting for tripwire');
        $this->checkInList($circuit, [self::NO_VALID_CIRCUIT, self::VALID_CIRCUIT], 'Invalid circuit setting for tripwire');
        $this->checkInList($armed, [self::ARMED, self::DISARMED], 'Invalid armed setting for tripwire');

        $this->setBlockData($active | $suspended | $circuit | $armed);
    }
}
