<?php

namespace MinecraftMapEditor;

/**
 * The main class through which we interact with a world.
 */
class World
{
    /** @var Region[] Array of Regions */
    private $regions = [];

    /** @var string Path to world **/
    private $path;

    /**
     * Initialise a world for editing.
     *
     * @param string $path The path to the world folder
     */
    public function __construct($path)
    {
        // Check the path is valid
        if (!is_dir($path)) {
            throw new \Exception('Path is not valid');
        }

        // Quick check to see if it's a Minecraft World
        if (!is_file($path.'level.dat')) {
            throw new \Exception('Path does not point to a Minecraft world');
        }

        // Path is valid, so save it
        $this->path = $path;
    }

    /**
     * Set a block in the world. Will overwrite a block if one exists at the co-ordinates.
     *
     * @param Coords\BlockCoords $coords Co-ordinates of the block
     * @param array              $block  Information about the new block
     */
    public function setBlock(Coords\BlockCoords $coords, $block)
    {
        // Get the region reference from the block co-ordinates
        $regionRef = $coords->toRegionRef();
        $this->initRegion($regionRef);
        $this->regions[$regionRef->toKey()]->setBlock($coords, $block);
    }

    /**
     * Get information about the block at the given co-ordinates.
     *
     * @param Coords\BlockCoords $coords Co-ordinates of the block
     *
     * @return array Information about the block
     */
    public function getBlock(Coords\BlockCoords $coords)
    {
        $regionRef = $coords->toRegionRef();
        $this->initRegion($regionRef);

        return $this->regions[$regionRef->toKey()]->getBlock($coords);
    }

    /**
     * Initialise a region (or check that it is initialised).
     *
     * @param Coords\RegionRef $regionRef
     */
    private function initRegion(Coords\RegionRef $regionRef)
    {
        if (!isset($this->regions[$regionRef->toKey()])) {
            $this->regions[$regionRef->toKey()] = new Region($regionRef, $this->path);
        }
    }

    /**
     * Save the world back to disk.
     */
    public function save()
    {
        // Save each initialised region
        foreach ($this->regions as $key => $region) {
            $region->save();
            unset($this->regions[$key]);
        }
    }
}
