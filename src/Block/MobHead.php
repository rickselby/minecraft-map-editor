<?php

namespace MinecraftMapEditor\Block;

class MobHead extends \MinecraftMapEditor\Block implements Interfaces\OrientFine
{
    use Traits\Create, Traits\EntityData;

    const PLACE_FLOOR = 1;
    const PLACE_WALL = 2;

    const SKULL_SKELETON = 0;
    const SKULL_WITHER_SKELETON = 1;
    const SKULL_ZOMBIE = 2;
    const SKULL_HEAD = 3;
    const SKULL_CREEPER = 4;

    /**
     * Get a mob head, with the given placement. If it's a player's head, BOTH
     * the ownerName and ownerID need to be set.
     *
     * @param int    $placement   One of the PLACE_ class constants
     * @param int    $orientation One of the ORIENT_ class constants
     * @param int    $type        One of the SKULL_ class constants
     * @param string $ownerName   Name of the player's head
     * @param string $ownerID     ID of the player's heads
     *
     * @throws \Exception
     */
    public function __construct($placement, $orientation, $type, $ownerName = '', $ownerID = '')
    {
        $this->setBlockIDFor(Ref::MOB_HEAD);

        $this->initEntityData('Skull');

        // This whole placement / orientation is very similar to signs and banners,
        // but just different enough that I can't reuse code. Argh.
        $this->checkDataRefValidStartsWith($placement, 'PLACE_', 'Invalid placement for mob head');
        $this->checkOrientation($placement, $orientation);

        $this->checkDataRefValidStartsWith($type, 'SKULL_', 'Invalid skull type');
        $this->entityData->addChild(\Nbt\Tag::tagByte('SkullType', $type));

        if ($type == self::SKULL_HEAD) {
            $this->entityData->addChild(\Nbt\Tag::tagCompound('Owner', [
                \Nbt\Tag::tagString('Name', $ownerName),
                \Nbt\Tag::tagString('Id', $ownerID),
            ]));
        }
    }

    /**
     * Check the orientation of the mob head based on the placement.
     *
     * @param int $placement
     * @param int $orientation
     */
    protected function checkOrientation($placement, $orientation)
    {
        $rotValue = 0;
        switch ($placement) {
            case self::PLACE_WALL:
                $this->checkWallOrientation($orientation);
                break;
            case self::PLACE_FLOOR:
                $this->setBlockData(1);
                $rotValue = $orientation;
                break;
        }
        $this->entityData->addChild(\Nbt\Tag::tagByte('Rot', $rotValue));
    }

    /**
     * Set the block data appropriately for the wall orientation.
     *
     * @param int $orientation
     */
    protected function checkWallOrientation($orientation)
    {
        switch ($orientation) {
            case self::ORIENT_NORTH:
                $this->setBlockData(2);
                break;
            case self::ORIENT_SOUTH:
                $this->setBlockData(3);
                break;
            case self::ORIENT_EAST:
                $this->setBlockData(4);
                break;
            case self::ORIENT_WEST:
                $this->setBlockData(5);
                break;
        }
    }
}
