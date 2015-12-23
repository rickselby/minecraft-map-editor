<?php

namespace MinecraftMapEditor\Block;

class Banner extends Shared\BannerSign implements Shared\Colors
{
    use Shared\EntityData;

    const
        PATTERN_STRIPE_BOTTOM = 'bs',
        PATTERN_STRIPE_TOP = 'ts',
        PATTERN_STRIPE_LEFT = 'ls',
        PATTERN_STRIPE_RIGHT = 'rs',
        PATTERN_STRIPE_CENTER = 'cs',
        PATTERN_STRIPE_MIDDLE = 'ms',
        PATTERN_STRIPE_DOWN_RIGHT = 'drs',
        PATTERN_STRIPE_DOWN_LEFT = 'dls',
        PATTERN_STRIPES_SMALL = 'ss',
        PATTERN_CROSS_DIAGONAL = 'cr',
        PATTERN_CROSS_SQUARE = 'sc',
        PATTERN_DIAGONAL_LEFT_OF = 'ld',
        PATTERN_DIAGONAL_RIGHT_OF = 'rd',
        PATTERN_DIAGONAL_UPSIDE_DOWN_LEFT_OF = 'lud',
        PATTERN_DIAGONAL_UPSIDE_DOWN_RIGHT_OF = 'rud',
        PATTERN_HALF_VERTICAL_LEFT = 'vh',
        PATTERN_HALF_VERTICAL_RIGHT = 'vhr',
        PATTERN_HALF_HORIZONTAL_TOP = 'hh',
        PATTERN_HALF_HORIZONTAL_BOTTOM = 'hhb',
        PATTERN_CORNER_BOTTOM_LEFT = 'bl',
        PATTERN_CORNER_BOTTOM_RIGHT = 'br',
        PATTERN_CORNER_TOP_LEFT = 'tl',
        PATTERN_CORNER_TOP_RIGHT = 'tr',
        PATTERN_TRIANGLE_BOTTOM = 'bt',
        PATTERN_TRIANGLE_TOP = 'tt',
        PATTERN_TRIANGLE_BOTTOM_SAWTOOTH = 'bts',
        PATTERN_TRIANGLE_TOP_SAWTOOTH = 'tts',
        PATTERN_MIDDLE_CIRCLE = 'mc',
        PATTERN_MIDDLE_RHOMBUS = 'mr',
        PATTERN_BORDER = 'bo',
        PATTERN_BORDER_CURLY = 'cbo',
        PATTERN_BRICK = 'bri',
        PATTERN_GRADIENT_TOP = 'gra',
        PATTERN_GRADIENT_BOTTOM = 'gru',
        PATTERN_CREEPER = 'cre',
        PATTERN_SKULL = 'sku',
        PATTERN_FLOWER = 'flo',
        PATTERN_MOJANG = 'moj';

    /**
     * Get a banner, with the given orientation.
     *
     * @param int   $blockRef    One of the BANNER_ blockRefs
     * @param int   $orientation Orientation of the banner; one of the class constants
     * @param int   $baseColor   Base colour of the banner
     * @param array $patterns    List of patterns, in order
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $orientation, $baseColor, $patterns)
    {
        // Deal with the block entity data
        $entityData = new \Nbt\Node();
        $this->initEntityData($entityData, 'Banner');

        $this->checkDataRefValidStartsWith($baseColor, 'COLOR_', 'Invalid base color for banner');

        // Set base colour
        $entityData->addChild(\Nbt\Tag::tagInt('Base', $baseColor));

        // Set up the pattern list
        $patternList = \Nbt\Tag::tagList('Patterns', \Nbt\Tag::TAG_COMPOUND, []);
        $entityData->addChild($patternList);

        foreach ($patterns as $pattern) {
            // Check the pattern details are valid
            $this->checkDataRefValidStartsWith($pattern['color'], 'COLOR_', 'Invalid base color for banner pattern');
            $this->checkDataRefValidStartsWith($pattern['pattern'], 'PATTERN_', 'Invalid pattern reference for banner pattern');
            // Add the pattern to the list
            $patternList->addChild(\Nbt\Tag::tagCompound('', [
                \Nbt\Tag::tagInt('Color', $pattern['color']),
                \Nbt\Tag::tagString('Pattern', $pattern['pattern']),
            ]));
        }

        parent::__construct(
            $blockRef,
            $orientation,
            Ref::BANNER_STANDING,
            Ref::BANNER_WALL,
            $entityData
        );
    }
}
