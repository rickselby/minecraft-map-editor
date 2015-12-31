<?php

namespace MinecraftMapEditor\Block;

/**
 * A list of Block IDs and Block Data for all blocks.
 *
 * [blockID, blockData, {optional} class for initialisation}]
 *
 * We could (should?) have keyed each block array with names, but this way it's
 * a smaller file and slightly more legible.
 */
class IDs
{
    /** @var array[] Block ID and Data for each block **/
    public static $list = [
        Ref::AIR => [0, 0],

        Ref::STONE             => [1, 0],
        Ref::GRANITE           => [1, 1],
        Ref::GRANITE_POLISHED  => [1, 2],
        Ref::DIORITE           => [1, 3],
        Ref::DIORITE_POLISHED  => [1, 4],
        Ref::ANDESITE          => [1, 5],
        Ref::ANDESITE_POLISHED => [1, 6],

        Ref::GRASS_BLOCK => [2, 0],

        Ref::DIRT        => [3, 0],
        Ref::DIRT_COARSE  => [3, 1],
        Ref::PODZOL      => [3, 2],

        Ref::COBBLESTONE => [4, 0],

        Ref::WOOD_PLANK_OAK      => [5, 0],
        Ref::WOOD_PLANK_SPRUCE   => [5, 1],
        Ref::WOOD_PLANK_BIRCH    => [5, 2],
        Ref::WOOD_PLANK_JUNGLE   => [5, 3],
        Ref::WOOD_PLANK_ACACIA   => [5, 4],
        Ref::WOOD_PLANK_DARK_OAK => [5, 5],

        Ref::SAPLING_OAK      => [6, 0],
        Ref::SAPLING_SPRUCE   => [6, 1],
        Ref::SAPLING_BIRCH    => [6, 2],
        Ref::SAPLING_JUNGLE   => [6, 3],
        Ref::SAPLING_ACACIA   => [6, 4],
        Ref::SAPLING_DARK_OAK => [6, 5],

        Ref::BEDROCK       => [7, 0],
        Ref::WATER_FLOWING => [8, 0, 'FlowingLiquid'],
        Ref::WATER_STILL   => [9, 0],
        Ref::LAVA_FLOWING  => [10, 0, 'FlowingLiquid'],
        Ref::LAVA_STILL    => [11, 0],

        Ref::SAND     => [12, 0],
        Ref::SAND_RED => [12, 1],

        Ref::GRAVEL   => [13, 0],
        Ref::GOLD_ORE => [14, 0],
        Ref::IRON_ORE => [15, 0],
        Ref::COAL_ORE => [16, 0],

        // Block 17: 4 and 8 specify the orientation
        Ref::WOOD_OAK    => [17, 0, 'Wood'],
        Ref::WOOD_SPRUCE => [17, 1, 'Wood'],
        Ref::WOOD_BIRCH  => [17, 2, 'Wood'],
        Ref::WOOD_JUNGLE => [17, 3, 'Wood'],

        // Block 18: 4 and 8 specify decay values
        Ref::LEAVES_OAK    => [18, 0, 'Leaves'],
        Ref::LEAVES_SPRUCE => [18, 1, 'Leaves'],
        Ref::LEAVES_BIRCH  => [18, 2, 'Leaves'],
        Ref::LEAVES_JUNGLE => [18, 3, 'Leaves'],

        Ref::SPONGE     => [19, 0],
        Ref::SPONGE_WET => [19, 1],

        Ref::GLASS              => [20, 0],
        Ref::LAPIS_LAZULI_ORE   => [21, 0],
        Ref::LAPIS_LAZULI_BLOCK => [22, 0],
        Ref::DISPENSER          => [23, 0, 'Dropper'],

        Ref::SANDSTONE          => [24, 0],
        Ref::SANDSTONE_CHISELED => [24, 1],
        Ref::SANDSTONE_SMOOTH   => [24, 2],

        Ref::NOTE_BLOCK    => [25, 0],
        Ref::BED           => [26, 0, 'Bed'],
        Ref::RAIL_POWERED  => [27, 0, 'RedstoneRail'],
        Ref::RAIL_DETECTOR => [28, 0, 'RedstoneRail'],
        Ref::PISTON_STICKY => [29, 0, 'Piston'],
        Ref::COBWEB        => [30, 0],

        Ref::DEAD_SHRUB => [31, 0],
        Ref::GRASS      => [31, 1],
        Ref::FERN       => [31, 2],

        Ref::DEAD_BUSH   => [32, 0],
        Ref::PISTON      => [33, 0, 'Piston'],
        Ref::PISTON_HEAD => [34, 0, 'PistonHead'],
        Ref::WOOL        => [35, 0, 'Colored'],
        Ref::DANDELION   => [37, 0],

        Ref::POPPY        => [38, 0],
        Ref::BLUE_ORCHID  => [38, 1],
        Ref::ALLIUM       => [38, 2],
        Ref::AZURE_BLUET  => [38, 3],
        Ref::TULIP_RED    => [38, 4],
        Ref::TULIP_ORANGE => [38, 5],
        Ref::TULIP_WHITE  => [38, 6],
        Ref::TULIP_PINK   => [38, 7],
        Ref::OXEYE_DAISY  => [38, 8],

        Ref::MUSHROOM_BROWN => [39, 0],
        Ref::MUSHROOM_RED   => [40, 0],
        Ref::GOLD_BLOCK     => [41, 0],
        Ref::IRON_BLOCK     => [42, 0],

        Ref::DOUBLE_SLAB_STONE        => [43, 0, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_SANDSTONE    => [43, 1, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_STONE_WOOD   => [43, 2, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_COBBLESTONE  => [43, 3, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_BRICK        => [43, 4, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_STONE_BRICK  => [43, 5, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_NETHER_BRICK => [43, 6, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_QUARTZ       => [43, 7, 'DoubleSlab'],

        Ref::SLAB_STONE        => [44, 0, 'Slab'],
        Ref::SLAB_SANDSTONE    => [44, 1, 'Slab'],
        Ref::SLAB_STONE_WOOD   => [44, 2, 'Slab'],
        Ref::SLAB_COBBLESTONE  => [44, 3, 'Slab'],
        Ref::SLAB_BRICK        => [44, 4, 'Slab'],
        Ref::SLAB_STONE_BRICK  => [44, 5, 'Slab'],
        Ref::SLAB_NETHER_BRICK => [44, 6, 'Slab'],
        Ref::SLAB_QUARTZ       => [44, 7, 'Slab'],

        Ref::BRICKS                => [45, 0],
        Ref::TNT                   => [46, 0],
        Ref::BOOKSHELF             => [47, 0],
        Ref::COBBLESTONE_MOSSY     => [48, 0],
        Ref::OBSIDIAN              => [49, 0],
        Ref::TORCH                 => [50, 0, 'Torch'],
        Ref::FIRE                  => [51, 0, 'Fire'],
        Ref::MOB_SPAWNER           => [52, 0, 'MobSpawner'],
        Ref::STAIRS_WOOD_OAK       => [53, 0, 'Stairs'],
        Ref::CHEST                 => [54, 0, 'Chest'],
        Ref::REDSTONE_WIRE         => [55, 0, 'RedstoneWire'],
        Ref::DIAMOND_ORE           => [56, 0],
        Ref::DIAMOND_BLOCK         => [57, 0],
        Ref::CRAFTING_TABLE        => [58, 0],
        Ref::WHEAT                 => [59, 0, 'Crops'],
        Ref::FARMLAND              => [60, 0, 'Farmland'],
        Ref::FURNACE               => [61, 0, 'Furnace'],
        Ref::FURNACE_BURNING       => [62, 0, 'Furnace'],
        Ref::SIGN_STANDING         => [63, 0, 'Sign'],
        Ref::DOOR_WOOD_OAK         => [64, 0, 'Door'],
        Ref::LADDER                => [65, 0, 'Ladder'],
        Ref::RAIL                  => [66, 0, 'Rail'],
        Ref::STAIRS_COBBLESTONE    => [67, 0, 'Stairs'],
        Ref::SIGN_WALL             => [68, 0, 'Sign'],
        Ref::LEVER                 => [69, 0, 'Lever'],
        Ref::PRESSURE_PLATE_STONE  => [70, 0, 'PressurePlate'],
        Ref::DOOR_IRON             => [71, 0, 'Door'],
        Ref::PRESSURE_PLATE_WOOD   => [72, 0, 'PressurePlate'],
        Ref::REDSTONE_ORE          => [73, 0],
        Ref::REDSTONE_ORE_GLOWING  => [74, 0],
        Ref::REDSTONE_TORCH_OFF    => [75, 0, 'Torch'],
        Ref::REDSTONE_TORCH_ON     => [76, 0, 'Torch'],
        Ref::BUTTON_STONE          => [77, 0, 'Button'],
        Ref::SNOW_LAYER            => [78, 0, 'SnowLayer'],
        Ref::ICE                   => [79, 0],
        Ref::SNOW_BLOCK            => [80, 0],
        Ref::CACTUS                => [81, 0, 'Cactus'],
        Ref::CLAY                  => [82, 0],
        Ref::SUGAR_CANE            => [83, 0, 'SugarCane'],
        Ref::JUKEBOX               => [84, 0, 'Jukebox'],
        Ref::FENCE_OAK             => [85, 0],
        Ref::PUMPKIN               => [86, 0, 'Pumpkin'],
        Ref::NETHERRACK            => [87, 0],
        Ref::SAND_SOUL             => [88, 0],
        Ref::GLOWSTONE             => [89, 0],
        Ref::NETHER_PORTAL         => [90, 0],
        Ref::JACK_O_LANTERN        => [91, 0, 'Pumpkin'],
        Ref::CAKE                  => [92, 0, 'Cake'],
        Ref::REDSTONE_REPEATER_OFF => [93, 0, 'RedstoneRepeater'],
        Ref::REDSTONE_REPEATER_ON  => [94, 0, 'RedstoneRepeater'],
        Ref::GLASS_STAINED         => [95, 0, 'Colored'],
        Ref::TRAPDOOR_WOODEN       => [96, 0, 'Trapdoor'],

        Ref::MONSTER_EGG_STONE                => [97, 0],
        Ref::MONSTER_EGG_COBBLESTONE          => [97, 1],
        Ref::MONSTER_EGG_STONE_BRICK          => [97, 2],
        Ref::MONSTER_EGG_STONE_BRICK_MOSSY    => [97, 3],
        Ref::MONSTER_EGG_STONE_BRICK_CRACKED  => [97, 4],
        Ref::MONSTER_EGG_STONE_BRICK_CHISELED => [97, 5],

        Ref::STONE_BRICKS          => [98, 0],
        Ref::STONE_BRICKS_MOSSY    => [98, 1],
        Ref::STONE_BRICKS_CRACKED  => [98, 2],
        Ref::STONE_BRICKS_CHISELED => [98, 3],

        Ref::MUSHROOM_BLOCK_BROWN => [ 99, 0, 'Mushroom'],
        Ref::MUSHROOM_BLOCK_RED   => [100, 0, 'Mushroom'],
        Ref::IRON_BARS            => [101, 0],
        Ref::GLASS_PANE           => [102, 0],
        Ref::MELON                => [103, 0],
        Ref::STEM_PUMPKIN         => [104, 0, 'Stem'],
        Ref::STEM_MELON           => [105, 0, 'Stem'],
        Ref::VINES                => [106, 0, 'Vines'],
        Ref::FENCE_GATE_OAK       => [107, 0, 'FenceGate'],
        Ref::STAIRS_BRICK         => [108, 0, 'Stairs'],
        Ref::STAIRS_STONE_BRICK   => [109, 0, 'Stairs'],
        Ref::MYCELIUM             => [110, 0],
        Ref::LILY_PAD             => [111, 0],
        Ref::NETHER_BRICK         => [112, 0],
        Ref::FENCE_NETHER_BRICK   => [113, 0],
        Ref::STAIRS_NETHER_BRICK  => [114, 0, 'Stairs'],
        Ref::NETHER_WART          => [115, 0, 'NetherWart'],
        Ref::ENCHANTMENT_TABLE    => [116, 0, 'EnchantingTable'],
        Ref::BREWING_STAND        => [117, 0, 'BrewingStand'],
        Ref::CAULDRON             => [118, 0, 'Cauldron'],
        Ref::END_PORTAL           => [119, 0, 'EndPortal'],
        Ref::END_PORTAL_FRAME     => [120, 0, 'EndPortalFrame'],
        Ref::END_STONE            => [121, 0],
        Ref::DRAGON_EGG           => [122, 0],
        Ref::REDSTONE_LAMP_OFF    => [123, 0],
        Ref::REDSTONE_LAMP_ON     => [124, 0],

        Ref::DOUBLE_SLAB_WOOD_OAK      => [125, 0, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_WOOD_SPRUCE   => [125, 1, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_WOOD_BIRCH    => [125, 2, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_WOOD_JUNGLE   => [125, 3, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_WOOD_ACACIA   => [125, 4, 'DoubleSlab'],
        Ref::DOUBLE_SLAB_WOOD_DARK_OAK => [125, 5, 'DoubleSlab'],

        Ref::SLAB_WOOD_OAK      => [126, 0, 'Slab'],
        Ref::SLAB_WOOD_SPRUCE   => [126, 1, 'Slab'],
        Ref::SLAB_WOOD_BIRCH    => [126, 2, 'Slab'],
        Ref::SLAB_WOOD_JUNGLE   => [126, 3, 'Slab'],
        Ref::SLAB_WOOD_ACACIA   => [126, 4, 'Slab'],
        Ref::SLAB_WOOD_DARK_OAK => [126, 5, 'Slab'],

        Ref::COCOA              => [127, 0, 'Cocoa'],
        Ref::STAIRS_SANDSTONE   => [128, 0, 'Stairs'],
        Ref::EMERALD_ORE        => [129, 0],
        Ref::CHEST_ENDER        => [130, 0, 'Chest'],
        Ref::TRIPWIRE_HOOK      => [131, 0, 'TripwireHook'],
        Ref::TRIPWIRE           => [132, 0, 'Tripwire'],
        Ref::EMERALD_BLOCK      => [133, 0],
        Ref::STAIRS_WOOD_SPRUCE => [134, 0, 'Stairs'],
        Ref::STAIRS_WOOD_BIRCH  => [135, 0, 'Stairs'],
        Ref::STAIRS_WOOD_JUNGLE => [136, 0, 'Stairs'],
        Ref::COMMAND_BLOCK      => [137, 0, 'CommandBlock'],
        Ref::BEACON             => [138, 0, 'Beacon'],

        Ref::COBBLESTONE_WALL       => [139, 0],
        Ref::COBBLESTONE_WALL_MOSSY => [139, 1],

        Ref::FLOWER_POT                    => [140, 0, 'FlowerPot'],
        Ref::CARROTS                       => [141, 0, 'Crops'],
        Ref::POTATOES                      => [142, 0, 'Crops'],
        Ref::BUTTON_WOODEN                 => [143, 0, 'Button'],
        Ref::MOB_HEAD                      => [144, 0, 'MobHead'],
        Ref::ANVIL                         => [145, 0, 'Anvil'],
        Ref::CHEST_TRAPPED                 => [146, 0, 'Chest'],
        Ref::PRESSURE_PLATE_WEIGHTED_LIGHT => [147, 0, 'PressurePlate'],
        Ref::PRESSURE_PLATE_WEIGHTED_HEAVY => [148, 0, 'PressurePlate'],
        Ref::REDSTONE_COMPARATOR           => [149, 0, 'RedstoneComparator'],
        Ref::DAYLIGHT_SENSOR               => [151, 0, 'RedstoneDaylightSensor'],
        Ref::REDSTONE_BLOCK                => [152, 0],
        Ref::NETHER_QUARTZ_ORE             => [153, 0],
        Ref::HOPPER                        => [154, 0, 'Hopper'],

        Ref::QUARTZ_BLOCK          => [155, 0],
        Ref::QUARTZ_BLOCK_CHISELED => [155, 1],
        Ref::QUARTZ_BLOCK_PILLAR   => [155, 2],

        Ref::STAIRS_QUARTZ      => [156, 0, 'Stairs'],
        Ref::RAIL_ACTIVATOR     => [157, 0, 'RedstoneRail'],
        Ref::DROPPER            => [158, 0, 'Dropper'],
        Ref::CLAY_STAINED       => [159, 0, 'Colored'],
        Ref::GLASS_PANE_STAINED => [160, 0, 'Colored'],

        Ref::LEAVES_ACACIA   => [161, 0, 'Leaves'],
        Ref::LEAVES_DARK_OAK => [161, 1, 'Leaves'],

        Ref::WOOD_ACACIA   => [162, 0, 'Wood'],
        Ref::WOOD_DARK_OAK => [162, 1, 'Wood'],

        Ref::STAIRS_WOOD_ACACIA   => [163, 0, 'Stairs'],
        Ref::STAIRS_WOOD_DARK_OAK => [164, 0, 'Stairs'],
        Ref::SLIME_BLOCK          => [165, 0],
        Ref::BARRIER              => [166, 0],
        Ref::TRAPDOOR_IRON        => [167, 0, 'Trapdoor'],

        Ref::PRISMARINE        => [168, 0],
        Ref::PRISMARINE_BRICKS => [168, 1],
        Ref::PRISMARINE_DARK   => [168, 2],

        Ref::SEA_LANTERN => [169, 0],
        Ref::HAY_BALE    => [170, 0],

        Ref::CARPET => [171, 0, 'Colored'],

        Ref::CLAY_HARDENED => [172, 0],
        Ref::COAL_BLOCK    => [173, 0],
        Ref::ICE_PACKED    => [174, 0],

        Ref::SUNFLOWER         => [175, 0],
        Ref::LILAC             => [175, 1],
        Ref::GRASS_DOUBLE_TALL => [175, 2],
        Ref::FERN_LARGE        => [175, 3],
        Ref::ROSE_BUSH         => [175, 4],
        Ref::PEONY             => [175, 5],

        Ref::BANNER_STANDING          => [176, 0, 'Banner'],
        Ref::BANNER_WALL              => [177, 0, 'Banner'],
        Ref::DAYLIGHT_SENSOR_INVERTED => [178, 0, 'RedstoneDaylightSensor'],

        Ref::SANDSTONE_RED          => [179, 0],
        Ref::SANDSTONE_RED_CHISELED => [179, 1],
        Ref::SANDSTONE_RED_SMOOTH   => [179, 2],

        Ref::STAIRS_SANDSTONE_RED      => [180, 0, 'Stairs'],
        Ref::DOUBLE_SLAB_SANDSTONE_RED => [181, 0, 'DoubleSlab'],
        Ref::SLAB_SANDSTONE_RED        => [182, 0, 'Slab'],
        Ref::FENCE_GATE_SPRUCE         => [183, 0, 'FenceGate'],
        Ref::FENCE_GATE_BIRCH          => [184, 0, 'FenceGate'],
        Ref::FENCE_GATE_JUNGLE         => [185, 0, 'FenceGate'],
        Ref::FENCE_GATE_DARK_OAK       => [186, 0, 'FenceGate'],
        Ref::FENCE_GATE_ACACIA         => [187, 0, 'FenceGate'],
        Ref::FENCE_SPRUCE              => [188, 0],
        Ref::FENCE_BIRCH               => [189, 0],
        Ref::FENCE_JUNGLE              => [190, 0],
        Ref::FENCE_DARK_OAK            => [191, 0],
        Ref::FENCE_ACACIA              => [192, 0],
        Ref::DOOR_SPRUCE               => [193, 0, 'Door'],
        Ref::DOOR_BIRCH                => [194, 0, 'Door'],
        Ref::DOOR_JUNGLE               => [195, 0, 'Door'],
        Ref::DOOR_DARK_OAK             => [196, 0, 'Door'],
        Ref::DOOR_ACACIA               => [197, 0, 'Door'],
    ];
}
