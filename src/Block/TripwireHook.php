<?php

namespace MME\Block;

class TripwireHook extends \MME\Block implements Interfaces\FacingSouth0
{
    use Traits\Create;

    const NOT_CONNECTED = 0b0000;
    const CONNECTED = 0b0100;
    const ACTIVATED = 0b1000;

    /**
     * Get a tripwire hook facing the given way with the given state.
     *
     * @param int $facing One of the FACING_ class constants
     * @param int $state  Either TripwireHook::NOT_CONNECTED, TripwireHook::CONNECTED
     *                    or TripwireHook::ACTIVATED
     *
     * @throws \Exception
     */
    public function __construct($facing, $state)
    {
        $this->setBlockIDFor(Ref::TRIPWIRE_HOOK);

        $this->checkDataRefValidStartsWith($facing, 'FACING_', 'Invalid facing setting for tripwire hook');
        $this->checkInList(
            $state,
            [self::NOT_CONNECTED, self::CONNECTED, self::ACTIVATED],
            'Invalid state for tripwire hook'
        );

        $this->setBlockData($facing | $state);
    }
}
