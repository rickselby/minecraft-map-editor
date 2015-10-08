<?php

include('vendor'.DIRECTORY_SEPARATOR.'autoload.php');

use \MinecraftMapEditor\Coords\BlockCoords;

$world = new \MinecraftMapEditor\World('/local/sda7/rs506/mc/.minecraft/saves/Desert/');

var_dump($world->getBlock(new BlockCoords(5, 63, 5)));

$world->setBlock(new BlockCoords(5, 63, 5), ['blockID' => 7, 'blockData' => 0]);

$world->save();
