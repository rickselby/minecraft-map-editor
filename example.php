<?php

include('vendor'.DIRECTORY_SEPARATOR.'autoload.php');

use \MinecraftMapEditor\Coords\BlockCoords;

$world = new \MinecraftMapEditor\World('/path/to/minecraft/world/');

var_dump($world->getBlock(new BlockCoords(5, 5, 5)));

$world->setBlock(new BlockCoords(5, 5, 5), ['blockID' => 5, 'blockData' => 1]);

$world->save();
