<?php

namespace MinecraftMapEditor\Block;

class Banner extends \MinecraftMapEditor\Block implements
    Interfaces\Colors,
    Interfaces\OrientFine,
    Interfaces\Patterns
{
    use Traits\EntityData, Traits\StandingWall;

    /**
     * Get a banner, with the given orientation.
     *
     * @param int   $blockRef    One of the BANNER_ blockRefs
     * @param int   $orientation Orientation of the banner; one of the ORIENT_ class constants
     * @param int   $baseColor   Base colour of the banner, one of the COLOR_ class consants
     * @param array $patterns    List of patterns, in order
     *
     * @throws \Exception
     */
    public function __construct($blockRef, $orientation, $baseColor, $patterns)
    {
        $this->verifyStandingWall(
            $blockRef,
            $orientation,
            Ref::BANNER_STANDING,
            Ref::BANNER_WALL
        );

        // Deal with the block entity data
        $this->initEntityData('Banner');

        $this->bannerBaseColor($baseColor);

        $this->bannerPatterns($patterns);
    }

    /**
     * Set the banner base colour in the block entity data.
     *
     * @param int $baseColor
     */
    protected function bannerBaseColor($baseColor)
    {
        $this->checkDataRefValidStartsWith($baseColor, 'COLOR_', 'Invalid base color for banner');

        // Set base colour
        $this->entityData->addChild(
            \Nbt\Tag::tagInt(
                'Base',
                $this->bannerConvertColor($baseColor)
            )
        );
    }

    /**
     * Set the patterns for the banner.
     *
     * @param array $patterns
     */
    protected function bannerPatterns($patterns)
    {
        // Set up the pattern list
        $patternList = \Nbt\Tag::tagList('Patterns', \Nbt\Tag::TAG_COMPOUND, []);
        $this->entityData->addChild($patternList);

        foreach ($patterns as $pattern) {
            // Check the pattern details are valid
            $this->checkDataRefValidStartsWith($pattern['color'], 'COLOR_', 'Invalid base color for banner pattern');
            $this->checkDataRefValidStartsWith($pattern['pattern'], 'PATTERN_', 'Invalid pattern reference for banner pattern');
            // Add the pattern to the list
            $patternList->addChild(\Nbt\Tag::tagCompound('', [
                \Nbt\Tag::tagInt('Color', $this->bannerConvertColor($pattern['color'])),
                \Nbt\Tag::tagString('Pattern', $pattern['pattern']),
            ]));
        }
    }

    /**
     * Banners, why you invert the color list?
     *
     * @param int $color
     *
     * @return int
     */
    protected function bannerConvertColor($color)
    {
        return 15 - $color;
    }
}
