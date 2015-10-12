<?php

include('vendor'.DIRECTORY_SEPARATOR.'autoload.php');

use \MinecraftMapEditor\Coords\BlockCoords;

$world = new \MinecraftMapEditor\World('/path/to/minecraft/world/');

var_dump($world->getBlock(new BlockCoords(5, 5, 5)));

$world->setBlock(new BlockCoords(5, 5, 5), ['blockID' => 5, 'blockData' => 1]);
$world->setBlock(
    new BlockCoords(5, 6, 5),
    [
        'blockID' => 63,
        'blockData' => 4,
        'blockEntity' => \Nbt\Tag::tagCompound('', [
            \Nbt\Tag::tagString('id', 'Sign'),
            \Nbt\Tag::tagString('Text1', '"This is"'),
            \Nbt\Tag::tagString('Text2', '"a generated"'),
            \Nbt\Tag::tagString('Text3', '"sign"'),
            \Nbt\Tag::tagString('Text4', '""'),
        ]),
    ]
);

$world->save();
