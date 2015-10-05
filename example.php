<?php

include('vendor'.DIRECTORY_SEPARATOR.'autoload.php');

use \MinecraftMapEditor\Coords\BlockCoords;

$world = new \MinecraftMapEditor\World('/path/to/a/test/minecraft/world/');

$world->setBlock(new BlockCoords(5, 5, 5), ['blockID' => 7, 'blockData' => 0]);

$world->save();
