<?php

namespace MME\Block;

class Sign extends \MME\Block implements Interfaces\OrientFine
{
    use Traits\EntityData, Traits\StandingWall;

    /**
     * Get a sign, with the given orientation.
     *
     * @param int            $blockRef    One of the SIGN_ blockRefs
     * @param int            $orientation Orientation of the sign; one of the class constants
     * @param string[]       $textArray   Text for the sign; each line as a separate array element
     * @param \Nbt\Node|null $entityData  Complete entitydata tag, if required
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $orientation, $textArray, $entityData = null)
    {
        $this->verifyStandingWall($blockRef, $orientation, Ref::SIGN_STANDING, Ref::SIGN_WALL);

        $this->initEntityData('Sign', $entityData);

        $this->signAddText($textArray);
    }

    /**
     * Add the given text to the sign, if there is no text yet.
     *
     * @param string[] $textArray
     */
    protected function signAddText($textArray)
    {
        for ($i = 0; $i < 4; ++$i) {
            if (!isset($textArray[$i])) {
                $textArray[$i] = '';
            }

            // If there's already text in the entity data, don't overwrite it
            $this->createChildOnly(
                $this->entityData,
                'Text'.($i + 1),
                \Nbt\Tag::TAG_STRING,
                $textArray[$i]
            );
        }
    }
}
