# minecraft-map-editor
Simple region file editor coded in PHP

## What will it be?

It'll become a PHP library with functions you can use to manipulate Minecraft maps.

## What is it now?

A very early prototype, but showing what could be achieved.
Right now, it only supports reading and writing block IDs and block data from pre-existing chunks.
But with the saving code working, more functionality can be implemented...

## What's the plan?

Firstly, to complete the functionality:
* reset lightpopulated to 0 after update, to allow minecraft to recalculate lighting
* reading and writing block entity data
* reading and writing entities

Secondly, to make using the library easier:
* helper functions for squares, cubes, circles, spheres, other shapes and solids

Things that won't be done:
* Initialising empty chunks. No terrain generation here.
