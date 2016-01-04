<?php

namespace MME\Block;

class NoteBlock extends \MME\Block
{
    use Traits\Create, Traits\EntityData, Traits\CheckValue;

    /**
     * Get Nether Wart at the given stage of growth.
     *
     * @param int $note Note the block should play (0-15)
     *
     * @throws \Exception
     */
    public function __construct($note)
    {
        $this->setBlockIDAndDataFor(Ref::NOTE_BLOCK);
        $this->checkValue($note, 0, 15, 'Invalid note for note block');
        $this->initEntityData('Music');
        $this->entityData->addChild(\Nbt\Tag::tagByte('note', $note));
    }
}
