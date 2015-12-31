<?php

namespace MinecraftMapEditor\Block\Interfaces;
/**
 * Hopper doesn't use UP; use OutputFull if UP is required
 */
interface Output
{
    const OUTPUT_DOWN = 0;
    const OUTPUT_NORTH = 2;
    const OUTPUT_SOUTH = 3;
    const OUTPUT_WEST = 4;
    const OUTPUT_EAST = 5;
}
