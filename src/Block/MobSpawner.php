<?php

namespace MME\Block;

class MobSpawner extends \MME\Block
{
    use Traits\Create, Traits\EntityData;

    /**
     * Create a mob spawner. There's no checking of the information passed yet.
     * I don't know the valid values, etc; proper error checking is still to come.
     * Test your creations well!
     *
     * @param \Nbt\Node|null $spawnPotentials     List of potential spawns
     * @param string         $entityID            Entity name to spawn
     * @param \Nbt\Node|null $spawnData           Data to pass to the spawned mobs
     * @param int            $spawnCount          Number of mobs to attempt to spawn
     * @param int            $spawnRange          Radius of the spawn range
     * @param int            $delay               Ticks until next spawn
     * @param int            $minSpawnDelay       Minimum random delay to the next spawn
     * @param int            $maxSpawnDelay       Maximum random delay to the next spawn
     * @param int            $maxNearbyEntities   Can override the max number of entities nearby
     * @param int            $requiredPlayerRange Override the activation radius
     *
     * @throws \Exception
     */
    public function __construct($spawnPotentials, $entityID, $spawnData,
        $spawnCount, $spawnRange, $delay, $minSpawnDelay, $maxSpawnDelay,
        $maxNearbyEntities, $requiredPlayerRange)
    {
        $this->setBlockIDAndDataFor(Ref::MOB_SPAWNER);
        $this->initEntityData('MobSpawner');

        if ($spawnPotentials) {
            $this->entityData->addChild($spawnPotentials);
        }

        $this->entityData->addChild(\Nbt\Tag::tagString('EntityId', $entityID));

        if ($spawnData) {
            $this->entityData->addChild($spawnData);
        }

        $this->entityData->addChild(\Nbt\Tag::tagShort('SpawnCount', $spawnCount));
        $this->entityData->addChild(\Nbt\Tag::tagShort('SpawnRange', $spawnRange));
        $this->entityData->addChild(\Nbt\Tag::tagShort('Delay', $delay));
        $this->entityData->addChild(\Nbt\Tag::tagShort('MinSpawnDelay', $minSpawnDelay));
        $this->entityData->addChild(\Nbt\Tag::tagShort('MaxSpawnDelay', $maxSpawnDelay));
        $this->entityData->addChild(\Nbt\Tag::tagShort('MaxNearbyEntities', $maxNearbyEntities));
        $this->entityData->addChild(\Nbt\Tag::tagShort('RequiredPlayerRange', $requiredPlayerRange));
    }
}
