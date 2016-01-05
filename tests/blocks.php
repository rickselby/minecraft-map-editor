<?php

use MME\World;
use MME\Coords;
use MME\Block;
use MME\Stack;
use MME\Helper\Place;

include('../vendor/autoload.php');

$world = new World('path/to/minecraft/world');

Place::lines($world, new Coords\BlockCoords(0,4,0), Place::DIR_SOUTH, Place::DIR_EAST, [
    [
        new Block\Anvil(Block\Anvil::DAMAGE_NONE, Block\Anvil::DIRECTION_EAST_WEST),
        new Block\Anvil(Block\Anvil::DAMAGE_SLIGHT, Block\Anvil::DIRECTION_NORTH_SOUTH),
        new Block\Anvil(Block\Anvil::DAMAGE_VERY, Block\Anvil::DIRECTION_WEST_EAST),
        new Block\Anvil(Block\Anvil::DAMAGE_NONE, Block\Anvil::DIRECTION_SOUTH_NORTH),
    ],
    [
        new Block\Banner(Block\Ref::BANNER_STANDING, Block\Banner::ORIENT_NORTHEAST, Block\Banner::COLOR_BLUE),
        new Block\Banner(Block\Ref::BANNER_STANDING, Block\Banner::ORIENT_WESTSOUTHWEST, Block\Banner::COLOR_RED),
        new Block\Banner(Block\Ref::BANNER_WALL, Block\Banner::ORIENT_EAST, Block\Banner::COLOR_YELLOW),
        new Block\Banner(Block\Ref::BANNER_STANDING, Block\Banner::ORIENT_WEST, Block\Banner::COLOR_GREEN, [
            ['pattern' => Block\Banner::PATTERN_CREEPER, 'color' => Block\Banner::COLOR_WHITE],
        ]),
    ],
    [
        new Block\Beacon(Block\Beacon::POWER_HASTE, Block\Beacon::POWER_HASTE, 4),
        new Block\Beacon(Block\Beacon::POWER_SPEED, Block\Beacon::POWER_REGENERATION, 4),
    ],
    [
        new Block\Bed(Block\Bed::FACING_NORTH, Block\Bed::PART_HEAD),
        new Block\Bed(Block\Bed::FACING_NORTH, Block\Bed::PART_FOOT),
        new Block\Simple(Block\Ref::AIR),
        new Block\Bed(Block\Bed::FACING_SOUTH, Block\Bed::PART_FOOT),
        new Block\Bed(Block\Bed::FACING_SOUTH, Block\Bed::PART_HEAD),
    ],
    [
        new Block\BrewingStand(null, null, null, null, 0),
        new Block\BrewingStand(
            (new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(64),
            (new Stack())->setBlock(new Block\Simple(Block\Ref::ANDESITE))->setCount(64),
            (new Stack())->setBlock(new Block\Simple(Block\Ref::BOOKSHELF))->setCount(64),
            (new Stack())->setBlock(new Block\Simple(Block\Ref::GLASS))->setCount(64),
            200),
    ],
    [
        new Block\Button(Block\Ref::BUTTON_STONE, Block\Button::ATTACH_BOTTOM),
        new Block\Button(Block\Ref::BUTTON_STONE, Block\Button::ATTACH_EAST),
        new Block\Button(Block\Ref::BUTTON_STONE, Block\Button::ATTACH_NORTH),
        new Block\Button(Block\Ref::BUTTON_WOODEN, Block\Button::ATTACH_SOUTH),
        new Block\Button(Block\Ref::BUTTON_WOODEN, Block\Button::ATTACH_TOP),
        new Block\Button(Block\Ref::BUTTON_WOODEN, Block\Button::ATTACH_WEST),
    ],
    [
        new Block\Cake(0),
        new Block\Cake(3),
        new Block\Cake(6),
        new Block\Cauldron(Block\Cauldron::FILL_EMPTY),
        new Block\Cauldron(Block\Cauldron::FILL_THIRD),
        new Block\Cauldron(Block\Cauldron::FILL_TWO_THIRDS),
        new Block\Cauldron(Block\Cauldron::FILL_FULL),
        new Block\Simple(Block\Ref::AIR),
        new Block\Cactus(2),
        new Block\Simple(Block\Ref::AIR),
        new Block\Cactus(15),
    ],
    [
        new Block\Chest(Block\Ref::CHEST, Block\Chest::FACING_NORTH),
        new Block\Chest(Block\Ref::CHEST_TRAPPED, Block\Chest::FACING_SOUTH),
        new Block\Simple(Block\Ref::AIR),
        new Block\Chest(Block\Ref::CHEST, Block\Chest::FACING_WEST),
        new Block\Chest(Block\Ref::CHEST, Block\Chest::FACING_WEST),
        new Block\Simple(Block\Ref::AIR),
        new Block\Chest(Block\Ref::CHEST_ENDER, Block\Chest::FACING_NORTH),
    ],
    [
        new Block\Wood(Block\Ref::WOOD_JUNGLE, Block\Wood::UP_DOWN),
        new Block\Cocoa(Block\Cocoa::ATTACH_SOUTH, Block\Cocoa::STAGE_1),
        new Block\Cocoa(Block\Cocoa::ATTACH_NORTH, Block\Cocoa::STAGE_2),
        new Block\Wood(Block\Ref::WOOD_JUNGLE, Block\Wood::UP_DOWN),
        new Block\Cocoa(Block\Cocoa::ATTACH_SOUTH, Block\Cocoa::STAGE_3),
    ],
    [
        new Block\Colored(Block\Ref::WOOL, Block\Colored::COLOR_BLACK),
        new Block\Colored(Block\Ref::GLASS_STAINED, Block\Colored::COLOR_BLUE),
        new Block\Colored(Block\Ref::GLASS_PANE_STAINED, Block\Colored::COLOR_BROWN),
        new Block\Colored(Block\Ref::CLAY_STAINED, Block\Colored::COLOR_CYAN),
    ],
    [
        new Block\CommandBlock('say "hello"'),
        new Block\Crops(Block\Ref::WHEAT, 4),
        new Block\Crops(Block\Ref::CARROTS, 2),
        new Block\Crops(Block\Ref::POTATOES, 7),
    ],
    [
        new Block\DoubleSlab(Block\Ref::DOUBLE_SLAB_BRICK),
        new Block\DoubleSlab(Block\Ref::DOUBLE_SLAB_STONE),
        new Block\DoubleSlab(Block\Ref::DOUBLE_SLAB_STONE, Block\DoubleSlab::TEXTURE_TOP),
    ],
    [
        new Block\Dropper(Block\Ref::DROPPER, Block\Dropper::OUTPUT_NORTH),
        new Block\Dropper(Block\Ref::DISPENSER, Block\Dropper::OUTPUT_SOUTH),
        new Block\Simple(Block\Ref::AIR),
        new Block\Dropper(Block\Ref::DROPPER, Block\Dropper::OUTPUT_EAST,
            [
                (new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(32)->getForSlot(0),
                (new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(16)->getForSlot(8),
            ]
        ),
        new Block\Dropper(Block\Ref::DISPENSER, Block\Dropper::OUTPUT_EAST,
            (new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(16)->getForSlots([3,4,5])
        ),
    ],
    [
        new Block\EnchantingTable(),
        new Block\EndPortal(),
        new Block\EndPortalFrame(Block\EndPortalFrame::FACING_NORTH),
        new Block\EndPortalFrame(Block\EndPortalFrame::FACING_EAST, Block\EndPortalFrame::FILLED),
        new Block\Farmland(7),
        new Block\Farmland(0),
    ],
    [
        new Block\FenceGate(Block\Ref::FENCE_GATE_BIRCH, Block\FenceGate::FACING_NORTH, Block\FenceGate::CLOSED),
        new Block\FenceGate(Block\Ref::FENCE_GATE_OAK, Block\FenceGate::FACING_EAST, Block\FenceGate::CLOSED),
        new Block\FenceGate(Block\Ref::FENCE_GATE_JUNGLE, Block\FenceGate::FACING_SOUTH, Block\FenceGate::OPEN),
        new Block\FenceGate(Block\Ref::FENCE_GATE_ACACIA, Block\FenceGate::FACING_WEST, Block\FenceGate::OPEN),
    ],
    [
        new Block\Fire(0),
        new Block\Fire(14),
        new Block\FlowerPot(),
        new Block\FlowerPot(new Block\Cactus(1)),
    ],
    [
        new Block\FlowingLiquid(Block\Ref::WATER_FLOWING, 2),
        new Block\Simple(Block\Ref::AIR),
        new Block\FlowingLiquid(Block\Ref::WATER_FLOWING, 7),
        new Block\Simple(Block\Ref::AIR),
        new Block\FlowingLiquid(Block\Ref::LAVA_FLOWING, 8),
    ],
    [
        new Block\Furnace(Block\Ref::FURNACE, Block\Furnace::FACING_NORTH),
        new Block\Furnace(Block\Ref::FURNACE_BURNING, Block\Furnace::FACING_SOUTH),
        new Block\Simple(Block\Ref::AIR),
        new Block\Furnace(Block\Ref::FURNACE, Block\Furnace::FACING_NORTH,
            (new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(32),
            (new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(16),
            (new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(8)->setName('Bob')
        ),
        new Block\Hopper(Block\Hopper::OUTPUT_DOWN, [
            (new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(32)->getForSlot(0),
            (new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(16)->getForSlot(4),
        ]),
        new Block\Hopper(Block\Hopper::OUTPUT_SOUTH, [
            (new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(32)->getForSlot(0),
            (new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(16)->getForSlot(4),
        ]),
    ],
    [
        new Block\Jukebox(),
        new Block\Jukebox((new Stack())->setBlock(new Block\Simple(Block\Ref::BEDROCK))->setCount(2)),
        new Block\Ladder(Block\Ladder::ATTACH_NORTH),
        new Block\Ladder(Block\Ladder::ATTACH_WEST),
        new Block\Leaves(Block\Ref::LEAVES_ACACIA),
        new Block\Leaves(Block\Ref::LEAVES_JUNGLE, Block\Leaves::DECAY),
    ],
    [
        new Block\Lever(Block\Lever::ATTACH_WEST),
        new Block\Lever(Block\Lever::ATTACH_WEST, Block\Lever::ACTIVE),
        new Block\Lever(Block\Lever::ATTACH_BOTTOM_EAST),
        new Block\Lever(Block\Lever::ATTACH_BOTTOM_SOUTH),
        new Block\MobHead(
            Block\MobHead::PLACE_FLOOR,
            Block\MobHead::ORIENT_EASTNORTHEAST,
            Block\MobHead::SKULL_HEAD,
            'dJomp',
            '082eef29-a7c3-4e97-b7c4-4df5ca64aa3f'),
        new Block\MobHead(Block\MobHead::PLACE_FLOOR, Block\MobHead::ORIENT_NORTH, Block\MobHead::SKULL_CREEPER),
        new Block\MobHead(Block\MobHead::PLACE_WALL, Block\MobHead::ORIENT_WEST, Block\MobHead::SKULL_WITHER_SKELETON),
    ],
    [
        new Block\Mushroom(Block\Ref::MUSHROOM_BLOCK_BROWN, Block\Mushroom::CAP_TOP),
        new Block\Mushroom(Block\Ref::MUSHROOM_BLOCK_BROWN, Block\Mushroom::ALL_CAP),
        new Block\Mushroom(Block\Ref::MUSHROOM_BLOCK_BROWN, Block\Mushroom::ALL_PORES),
        new Block\Mushroom(Block\Ref::MUSHROOM_BLOCK_BROWN, Block\Mushroom::ALL_STEM),
        new Block\Mushroom(Block\Ref::MUSHROOM_BLOCK_RED, Block\Mushroom::CAP_TOP_EAST),
        new Block\Mushroom(Block\Ref::MUSHROOM_BLOCK_RED, Block\Mushroom::CAP_TOP),
        new Block\Mushroom(Block\Ref::MUSHROOM_BLOCK_RED, Block\Mushroom::CAP_TOP_WEST),
        new Block\Mushroom(Block\Ref::MUSHROOM_BLOCK_RED, Block\Mushroom::CAP_TOP_SOUTH),
    ],
    [
        new Block\NetherWart(0),
        new Block\NetherWart(3),
        new Block\NoteBlock(1),
        new Block\NoteBlock(9),
        new Block\NoteBlock(15),
    ],
    [
        new Block\Piston(Block\Ref::PISTON, Block\Piston::OUTPUT_UP),
        new Block\Piston(Block\Ref::PISTON_STICKY, Block\Piston::OUTPUT_SOUTH),
        new Block\Simple(Block\Ref::AIR),
        new Block\Piston(Block\Ref::PISTON, Block\Piston::OUTPUT_SOUTH, Block\Piston::EXTENDED),
        new Block\PistonHead(Block\PistonHead::NORMAL, Block\Piston::OUTPUT_SOUTH),
    ],
    [
        new Block\PressurePlate(Block\Ref::PRESSURE_PLATE_STONE),
        new Block\PressurePlate(Block\Ref::PRESSURE_PLATE_WEIGHTED_HEAVY),
        new Block\Simple(Block\Ref::AIR),
        new Block\Pumpkin(Block\Ref::PUMPKIN, Block\Pumpkin::FACING_NORTH),
        new Block\Pumpkin(Block\Ref::JACK_O_LANTERN, Block\Pumpkin::FACING_EAST),
        new Block\Pumpkin(Block\Ref::JACK_O_LANTERN, Block\Pumpkin::FACING_SOUTH),
    ],
    [
        new Block\Rail(Block\Rail::ORIENT_SOUTH_EAST),
        new Block\Rail(Block\Rail::ORIENT_NORTH_SOUTH),
        new Block\Rail(Block\Rail::ORIENT_SLOPED_SOUTH),
        new Block\Rail(Block\Rail::ORIENT_SLOPED_NORTH),
    ],
    [
        new Block\RedstoneComparator(Block\RedstoneComparator::FACING_NORTH, Block\RedstoneComparator::MODE_NORMAL),
        new Block\RedstoneComparator(Block\RedstoneComparator::FACING_SOUTH, Block\RedstoneComparator::MODE_SUBTRACTION),
        new Block\Simple(Block\Ref::AIR),
        new Block\RedstoneDaylightSensor(Block\Ref::DAYLIGHT_SENSOR, 6),
        new Block\RedstoneDaylightSensor(Block\Ref::DAYLIGHT_SENSOR_INVERTED, 15),
    ],
    [
        new Block\RedstoneRail(Block\Ref::RAIL_ACTIVATOR, Block\RedstoneRail::ORIENT_NORTH_SOUTH),
        new Block\RedstoneRail(Block\Ref::RAIL_DETECTOR, Block\RedstoneRail::ORIENT_EAST_WEST),
        new Block\RedstoneRail(Block\Ref::RAIL_POWERED, Block\RedstoneRail::ORIENT_SLOPED_SOUTH),
    ],
    [
        new Block\RedstoneRepeater(Block\Ref::REDSTONE_REPEATER_OFF, Block\RedstoneRepeater::FACING_NORTH, Block\RedstoneRepeater::DELAY_1),
        new Block\RedstoneRepeater(Block\Ref::REDSTONE_REPEATER_ON, Block\RedstoneRepeater::FACING_EAST, Block\RedstoneRepeater::DELAY_2),
        new Block\RedstoneRepeater(Block\Ref::REDSTONE_REPEATER_OFF, Block\RedstoneRepeater::FACING_SOUTH, Block\RedstoneRepeater::DELAY_3),
        new Block\RedstoneRepeater(Block\Ref::REDSTONE_REPEATER_ON, Block\RedstoneRepeater::FACING_WEST, Block\RedstoneRepeater::DELAY_4),
        new Block\Simple(Block\Ref::AIR),
        new Block\RedstoneWire(14),
        new Block\Simple(Block\Ref::AIR),
        new Block\RedstoneWire(4),
    ],
    [
        new Block\Sign(Block\Ref::SIGN_STANDING, Block\Sign::ORIENT_EASTSOUTHEAST, ['1','2','3','4']),
        new Block\Simple(Block\Ref::AIR),
        new Block\Slab(Block\Ref::SLAB_QUARTZ, Block\Slab::TOP),
        new Block\Slab(Block\Ref::SLAB_WOOD_DARK_OAK, Block\Slab::BOTTOM),
        new Block\Slab(Block\Ref::SLAB_SANDSTONE_RED, Block\Slab::TOP),
        new Block\Slab(Block\Ref::SLAB_STONE_BRICK, Block\Slab::BOTTOM),
    ],
    [
        new Block\SnowLayer(1),
        new Block\SnowLayer(6),
        new Block\Simple(Block\Ref::AIR),
        new Block\Stairs(Block\Ref::STAIRS_BRICK, Block\Stairs::ORIENT_NORTH),
        new Block\Stairs(Block\Ref::STAIRS_WOOD_DARK_OAK, Block\Stairs::ORIENT_SOUTH, Block\Stairs::UPSIDE_DOWN),
    ],
    [
        new Block\Stem(Block\Ref::STEM_MELON, 7),
        new Block\Stem(Block\Ref::STEM_PUMPKIN, 4),
        new Block\Simple(Block\Ref::AIR),
        new Block\SugarCane(0),
        new Block\SugarCane(15),
        new Block\Torch(Block\Ref::TORCH, Block\Torch::STANDING),
        new Block\Torch(Block\Ref::REDSTONE_TORCH_OFF, Block\Torch::ATTACH_NORTH),
        new Block\Torch(Block\Ref::REDSTONE_TORCH_ON, Block\Torch::ATTACH_SOUTH),
    ],
    [
        new Block\Trapdoor(Block\Ref::TRAPDOOR_WOODEN, Block\Trapdoor::HINGE_SOUTH, Block\Trapdoor::ON_BOTTOM),
        new Block\Trapdoor(Block\Ref::TRAPDOOR_IRON, Block\Trapdoor::HINGE_NORTH, Block\Trapdoor::ON_TOP),
        new Block\Trapdoor(Block\Ref::TRAPDOOR_WOODEN, Block\Trapdoor::HINGE_EAST, Block\Trapdoor::ON_TOP, Block\Trapdoor::STATE_OPEN),
    ],
    [
        new Block\Simple(Block\Ref::DIORITE),
        new Block\TripwireHook(Block\TripwireHook::ATTACH_NORTH, Block\TripwireHook::CONNECTED),
        new Block\Tripwire(Block\Tripwire::INACTIVE, Block\Tripwire::ON_BLOCK, Block\Tripwire::VALID_CIRCUIT, Block\Tripwire::ARMED),
        new Block\TripwireHook(Block\TripwireHook::ATTACH_SOUTH, Block\TripwireHook::CONNECTED),
        new Block\Simple(Block\Ref::DIORITE),
    ],
    [
        new Block\Vines(Block\Vines::NORTH),
        new Block\Vines([Block\Vines::EAST, Block\Vines::WEST]),
        new Block\Simple(Block\Ref::AIR),
        new Block\Wood(Block\Ref::WOOD_BIRCH, Block\Wood::NORTH_SOUTH),
        new Block\Simple(Block\Ref::AIR),
        new Block\Wood(Block\Ref::WOOD_SPRUCE, Block\Wood::EAST_WEST),
        new Block\Simple(Block\Ref::AIR),
        new Block\Wood(Block\Ref::WOOD_OAK, Block\Wood::UP_DOWN),
        new Block\Simple(Block\Ref::AIR),
        new Block\Wood(Block\Ref::WOOD_JUNGLE, Block\Wood::BARK_ONLY),
    ],
]);

$world->save();
