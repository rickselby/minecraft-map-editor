<?php

namespace MinecraftMapEditor\Block;

class Banner extends Shared\BannerSign
{
    /**
     * Get a banner, with the given orientation.
     *
     * @param int $blockRef    One of the BANNER_ blockRefs
     * @param int $orientation Orientation of the banner; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $orientation)
    {
        parent::__construct(
            $blockRef,
            $orientation,
            Ref::BANNER_STANDING,
            Ref::BANNER_WALL,
            null
        );
    }
}
