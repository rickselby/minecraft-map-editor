<?php

namespace MinecraftMapEditor\Block;

class Jukebox extends \MinecraftMapEditor\Block
{
    use Traits\Create;

    /**
     * Get a jukebox, optionally with the given disc inserted.
     *
     * @param ? $disc [optional]
     */
    public function __construct($disc = null)
    {
        $this->setBlockIDFor(Ref::JUKEBOX);

        $this->setBlockData($disc ? 1 : 0);
    }
}
