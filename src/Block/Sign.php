<?php

namespace MinecraftMapEditor\Block;

class Sign extends Shared\BannerSign
{
    use Shared\EntityData;

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
        $this->initEntityData($entityData, 'Sign');

        for ($i = 0; $i < 4; ++$i) {
            if (!isset($textArray[$i])) {
                $textArray[$i] = '';
            }

            $this->createChildOnly(
                $entityData,
                'Text'.($i + 1),
                \Nbt\Tag::TAG_STRING,
                $textArray[$i]
            );
        }

        parent::__construct(
            $blockRef,
            $orientation,
            Ref::SIGN_STANDING,
            Ref::SIGN_WALL,
            $entityData
        );
    }
}
