<?php

namespace MinecraftMapEditor;

class Region
{
    /** @var Chunk[] Array of Chunks **/
    private $chunks;

    /** @var array[] Array of chunk information (don't be reading chunks into memory unless we need to) **/
    private $chunkInfo;

    /** @var resource File pointer for region file **/
    private $fPtr;

    /** @var string Path to the current region file **/
    private $filePath;

    /**
     * Initialise a specific region file given the identifiers of the file.
     *
     * @param Coords\RegionRef $coords The reference to the region file
     */
    public function __construct($regionRef, $path)
    {
        // Set the file path
        $this->filePath = $path.'region'.DIRECTORY_SEPARATOR.'r.'.$regionRef->x.'.'.$regionRef->z.'.mca';

        if (!is_file($this->filePath)) {
            throw new \Exception('Region file path is invalid');
        }

        // Load in some basic info about the region file & its chunks
        $this->fPtr = fopen($this->filePath, 'rb');
        $this->chunkInfo = [];

        // First, parse the headers. Get the offsets and sector counts
        foreach (Coords\ChunkRef::zxList(32) as $chunkRef) {
            // Read the first three bytes as the offset (add 4th byte at start for padding for unpack)
            $this->chunkInfo[$chunkRef->toKey()]['offset'] = unpack('N', "\x00".fread($this->fPtr, 3))[1];
            // Then get the 'sector count' (single byte)
            $this->chunkInfo[$chunkRef->toKey()]['sectorCount'] = unpack('C', fread($this->fPtr, 1))[1];
        }
        // Next, read the timestamps
        foreach (Coords\ChunkRef::zxList(32) as $chunkRef) {
            $this->chunkInfo[$chunkRef->toKey()]['timestamp'] = unpack('N', fread($this->fPtr, 4))[1];
        }
    }

    /**
     * Set a block in the world. Will overwrite a block if one exists at the co-ordinates.
     *
     * @param Coords\BlockCoords $coords Co-ordinates of the block
     * @param array              $block  Information about the new block
     */
    public function setBlock($coords, $block)
    {
        // Get the chunk reference from the block co-ordinates
        $chunkRef = $coords->toChunkRef();
        $this->initChunk($chunkRef);
        $this->chunks[$chunkRef->toKey()]->setBlock($coords->toChunkCoords(), $block);
    }

    /**
     * Get information about the block at the given co-ordinates.
     *
     * @param Coords\BlockCoords $coords Co-ordinates of the block
     *
     * @return array Information about the block
     */
    public function getBlock($coords)
    {
        $chunkRef = $coords->toChunkRef();
        $this->initChunk($chunkRef);

        return $this->chunks[$chunkRef->toKey()]->getBlock($coords->toChunkCoords());
    }

    /**
     * Initialise a chunk (or check that it is initialised).
     *
     * @param Coords\ChunkCoords $chunkRef
     */
    private function initChunk($chunkRef)
    {
        if (!isset($this->chunks[$chunkRef->toKey()])) {
            // If the offset is zero, this chunk does not yet exist. ARGH
            if ($this->chunkInfo[$chunkRef->toKey()]['offset'] == 0) {
                // Do nothing, for now
                var_dump($chunkRef);
                var_dump($this->filePath);
                var_dump($this->chunkInfo[$chunkRef->toKey()]);
                throw new \Exception('Chunks must exist to be edited');
            } else {
                // Seek through the region file to the offset for the requested chunk
                fSeek($this->fPtr, $this->chunkInfo[$chunkRef->toKey()]['offset'] * 4096);
                // first 4 bytes is actual length of the rest of the data
                $length = unpack('N', fread($this->fPtr, 4))[1];
                // next byte is compression type
                $compressionType = unpack('C', fread($this->fPtr, 1))[1];
                // the rest is the chunk data
                $data = fread($this->fPtr, $length - 1);
                // uncompress the chunk data
                switch ($compressionType) {
                    case '1':
                        // gzip, unused
                        throw new \Exception('Need to code in GZIP uncompressing!');
                    case '2':
                        // zlib
                        $nbtString = gzuncompress($data);
                        break;
                }
                // now we can initialise the chunk based on the NBT string
                $this->chunks[$chunkRef->toKey()] = new Chunk($nbtString);
            }
        }
    }

    /**
     * Save the region file back to disk, if required.
     */
    public function save()
    {
        // Check if each loaded chunk has any changes
        // If none have changed, we don't need to alter the file
        $doSave = false;
        foreach ($this->chunks as $ref => $chunk) {
            if ($chunk->changed) {
                // We have a changed chunk
                $doSave = true;
                // Update the height map
                $chunk->updateHeightMap();
                // Get the compressed chunk data
                $compressedStr = gzcompress($chunk->getNBTstring());

                // Put together the chunk data to write to the file
                $this->chunkInfo[$ref]['data'] =
                    // 4 bytes of the length of the rest of the data
                    // (length of compressed data + 1 byte for compression type)
                    pack('N', strlen($compressedStr) + 1).pack('C', 2).$compressedStr;

                // We can now get rid of the chunk
                unset($this->chunk[$ref]);
                // And update the timestamp to show this chunk was just updated
                $this->chunkInfo[$ref]['timestamp'] = time();
            }
        }

        if ($doSave) {
            // Set up a temporary file to move things to.
            // Too much memory required to do everything in variables.
            $fTemp = tmpfile();
            // Skip the headers - we come back and set them afterwards
            fseek($fTemp, 8192);
            $offset = 2;

            foreach (Coords\ChunkRef::zxList(32) as $chunkRef) {
                // Chunks with zero offsets haven't yet been created
                if (!($this->chunkInfo[$chunkRef->toKey()]['offset'] == 0
                    && $this->chunkInfo[$chunkRef->toKey()]['sectorCount'] == 0)) {
                    // If we don't have the data yet, read it from the original file
                    if (!isset($this->chunkInfo[$chunkRef->toKey()]['data'])) {
                        fSeek($this->fPtr, $this->chunkInfo[$chunkRef->toKey()]['offset'] * 4096);
                        $this->chunkInfo[$chunkRef->toKey()]['data'] =
                            fread(
                                $this->fPtr,
                                $this->chunkInfo[$chunkRef->toKey()]['sectorCount'] * 4096
                            );
                    }

                    // Update the chunk offset
                    $this->chunkInfo[$chunkRef->toKey()]['offset'] = $offset;
                    // Update the sector count
                    $this->chunkInfo[$chunkRef->toKey()]['sectorCount'] =
                        ceil(strlen($this->chunkInfo[$chunkRef->toKey()]['data']) / 4096);

                    // Pad the data out to a multiple of 4096 bytes
                    $this->chunkInfo[$chunkRef->toKey()]['data'] = str_pad(
                        $this->chunkInfo[$chunkRef->toKey()]['data'],
                        $this->chunkInfo[$chunkRef->toKey()]['sectorCount'] * 4096,
                        0x00
                    );

                    // write this chunk to the file
                    fwrite($fTemp, $this->chunkInfo[$chunkRef->toKey()]['data']);
                    // get rid of the data from memory
                    unset($this->chunkInfo[$chunkRef->toKey()]['data']);
                    // update the offset for the next chunk
                    $offset += $this->chunkInfo[$chunkRef->toKey()]['sectorCount'];
                }
            }

            // Now we know the offsets, we can go back and write the headers
            fseek($fTemp, 0);
            foreach (Coords\ChunkRef::zxList(32) as $chunkRef) {
                // First 3 bytes are the offset (so use substr to get rid of the 1st byte)
                fwrite($fTemp, substr(pack('N', $this->chunkInfo[$chunkRef->toKey()]['offset']), 1));
                // Next byte is the sector count
                fwrite($fTemp, pack('C', $this->chunkInfo[$chunkRef->toKey()]['sectorCount']));
            }
            // and the timestamps
            foreach (Coords\ChunkRef::zxList(32) as $chunkRef) {
                // 4 bytes of timestamp
                fwrite($fTemp, pack('N', $this->chunkInfo[$chunkRef->toKey()]['timestamp']));
            }

            // Close the original region file
            fclose($this->fPtr);
            // Open the file again for writing (and truncate it)
            $outputFilePtr = fopen($this->filePath, 'wb');
            // back to the start of the temporary file
            rewind($fTemp);
            // copy the temporary file to the region file
            stream_copy_to_stream($fTemp, $outputFilePtr);
            // close both files
            fclose($outputFilePtr);
            fclose($fTemp);
        }
    }
}
