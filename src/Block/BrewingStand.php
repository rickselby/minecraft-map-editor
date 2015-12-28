<?php

namespace MinecraftMapEditor\Block;

class BrewingStand extends \MinecraftMapEditor\Block
{
    use Traits\Create, Traits\EntityData;

    /**
     * Get a brewing stand with the given bottles in place.
     *
     * @param \MinecraftMapEditor\Stack|null $eastItem       Data for the stack in the east bottle slot
     * @param \MinecraftMapEditor\Stack|null $southWestItem  Data for the stack in the south west bottle slot
     * @param \MinecraftMapEditor\Stack|null $northWestItem  Data for the stack in the north west bottle slot
     * @param \MinecraftMapEditor\Stack|null $ingredientItem Data for the stack in the ingredient slot
     * @param int                            $brewTime       The number of ticks the potions have been brewing for
     * @param string|null                    $customName     Custom name for the container, shows in GUI
     * @param string|null                    $lock           Lock the beacon so it can only be opened if the player
     *                                                       is holding an item whose name matches this string
     */
    public function __construct($eastItem, $southWestItem, $northWestItem, $ingredientItem, $brewTime, $customName = null, $lock = null)
    {
        $this->setBlockIDFor(Ref::BREWING_STAND);

        $data = 0;
        if ($eastItem) {
            $data |= 0b0001;
        }
        if ($southWestItem) {
            $data |= 0b0010;
        }
        if ($northWestItem) {
            $data |= 0b0100;
        }

        $this->setBlockData($data);

        // Yes, this says Cauldron, it's on purpose, it's how it's coded in the game
        $this->initEntityData('Cauldron');

        $this->entityData->addChild(\Nbt\Tag::tagInt('BrewTime', $brewTime));

        $this->setCustomName($customName);
        $this->setLock($lock);

        // Set up the items list tag. Will be 0 if no items; compound if at least
        // one item is present
        if ($eastItem || $southWestItem || $northWestItem || $ingredientItem) {
            $payload = \Nbt\Tag::TAG_COMPOUND;
        } else {
            $payload = \Nbt\Tag::TAG_END;
        }
        $itemsList = \Nbt\Tag::tagList('Items', $payload, []);
        $this->entityData->addChild($itemsList);

        // Process each item for the given slot
        foreach ([
            ['item' => $eastItem,       'slot' => 0],
            ['item' => $northWestItem,  'slot' => 1],
            ['item' => $southWestItem,  'slot' => 2],
            ['item' => $ingredientItem, 'slot' => 3],
        ] as $item) {
            if ($item['item']) {
                $tree = $item['item']->node;
                $this->updateChildOrCreate($tree, 'Slot', \Nbt\Tag::TAG_INT, $item['slot']);
                $itemsList->addChild($tree);
            }
        }
    }
}
