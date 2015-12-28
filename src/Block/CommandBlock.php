<?php

namespace MinecraftMapEditor\Block;

class CommandBlock extends \MinecraftMapEditor\Block
{
    use Traits\Create, Traits\EntityData;

    const TRACK_OUTPUT = 1;
    const NO_TRACK_OUTPUT = 0;

    /**
     * Add a command block.
     *
     * @param string         $command      Command that the block will run
     * @param int            $trackOutput  [optional] Either CommandBlock::TRACK_OUTPUT or CommandBlock::NO_TRACK_OUTPUT
     * @param \Nbt\Node|null $commandStats [optional] Command stats compound tag, if required.
     * @param string|null    $customName   [optional]
     * @param string|null    $lock         [optional]
     *
     * @throws \Exception
     */
    public function __construct($command, $trackOutput = self::TRACK_OUTPUT, $commandStats = null, $customName = null, $lock = null)
    {
        $this->setBlockIDAndDataFor(Ref::COMMAND_BLOCK);

        $this->initEntityData('Control');
        $this->entityData->addChild(\Nbt\Tag::tagString('Command', $command));
        $this->entityData->addChild(\Nbt\Tag::tagByte('TrackOutput', $trackOutput));

        $this->setCustomName($customName);
        $this->setLock($lock);
        if ($commandStats !== null) {
            $this->entityData->addChild($commandStats);
        }
    }
}
