<?php

namespace MinecraftMapEditor\Block;

class Jukebox extends \MinecraftMapEditor\Block
{
    /**
     * Get a jukebox, optionally with the given disc inserted.
     *
     * @param ? $disc [optional]
     */
    public function __construct($disc = null)
    {
        $data = $disc ? 0x1 : 0x0;

        $block = IDs::$list[Ref::JUKEBOX];

        parent::__construct($block[0], $data);
    }
}
