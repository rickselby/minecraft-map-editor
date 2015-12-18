<?php

namespace MinecraftMapEditor\Block;

/**
 * A list of constants relevant to block data.
 */
class DataRef
{
    use \ConstHelpers\Validating;

    const BED_DIRECTION_SOUTH = 0x0;
    const BED_DIRECTION_WEST = 0x1;
    const BED_DIRECTION_NORTH = 0x2;
    const BED_DIRECTION_EAST = 0x3;

    const BED_PART_FOOT = 0x0;
    const BED_PART_HEAD = 0x8;

    const PISTON_DIRECTION_DOWN = 0x0;
    const PISTON_DIRECTION_UP = 0x1;
    const PISTON_DIRECTION_NORTH = 0x2;
    const PISTON_DIRECTION_SOUTH = 0x3;
    const PISTON_DIRECTION_WEST = 0x4;
    const PISTON_DIRECTION_EAST = 0x5;

    const SLAB_BOTTOM = 0x0;
    const SLAB_TOP = 0x8;

    const TORCH_ATTACHED_WEST = 0x1;
    const TORCH_ATTACHED_EAST = 0x2;
    const TORCH_ATTACHED_NORTH = 0x3;
    const TORCH_ATTACHED_SOUTH = 0x4;
    const TORCH_STANDING = 0x5;

    const WOOD_UP_DOWN = 0x0;
    const WOOD_EAST_WEST = 0x1;
    const WOOD_NORTH_SOUTH = 0x2;
    const WOOD_BARK_ONLY = 0x3;
}
