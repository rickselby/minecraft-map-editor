<?php

namespace MinecraftMapEditor\Block;

class Sign extends \MinecraftMapEditor\Block\Shared\BannerSign
{
    /**
     * Get a sign, with the given orientation.
     *
     * @param int $blockRef    One of the SIGN_ blockRefs
     * @param int $orientation Orientation of the sign; one of the class constants
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $orientation)
    {
        parent::__construct(
            $blockRef,
            $orientation,
            Ref::SIGN_STANDING,
            Ref::SIGN_WALL
        );
    }
}
