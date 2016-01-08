<?php

namespace MME\Block;

class TripwireHook extends \MME\Block implements Interfaces\AttachSouth2
{
    use Traits\Create;

    const NOT_CONNECTED = 0b0000;
    const CONNECTED = 0b0100;
    const ACTIVATED = 0b1000;

    /**
     * Get a tripwire hook facing the given way with the given state.
     *
     * @param int $attach One of the ATTACH_ class constants
     * @param int $state  Either TripwireHook::NOT_CONNECTED, TripwireHook::CONNECTED
     *                    or TripwireHook::ACTIVATED
     *
     * @throws \Exception
     */
    public function __construct($attach, $state)
    {
        $this->setBlockIDFor(Ref::TRIPWIRE_HOOK);

        $this->checkDataRefValidStartsWith($attach, 'ATTACH_', 'Invalid attatchment setting for tripwire hook');
        $this->checkInList(
            $state,
            [self::NOT_CONNECTED, self::CONNECTED, self::ACTIVATED],
            'Invalid state for tripwire hook'
        );

        $this->setBlockData($attach | $state);
    }
}
