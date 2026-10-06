<?php

namespace JothamLec\Gruvbox;

/**
 * Gruvbox (github.com/morhetz/gruvbox) as a Statamic control-panel theme, in
 * the shape Statamic saves a user's `theme` preference: an id, a name, and
 * the colours, with dark mode's as `dark-` keys beside the light ones.
 *
 * Statamic's grey ramp runs from the page (50) to the darkest surface (950),
 * and dark mode draws from its dark end, so Gruvbox's neutrals, from light
 * cream to dark bg0_h, are one ramp for both modes. Only the accents
 * change: Gruvbox's faded colours on cream, its bright ones on dark.
 */
final class Theme
{
    /** The neutrals, light to dark. */
    public const array GRAYS = [
        // Gruvbox's lightest cream three quarters of the way to white: Statamic's
        // buttons and dropdowns fade from white to gray-50, so this keeps the fade faint.
        50 => '#fdfcf5',
        100 => '#fbf1c7', // bg0
        150 => '#f2e5bc', // bg0_s
        200 => '#ebdbb2', // bg1
        300 => '#d5c4a1', // bg2
        400 => '#bdae93', // bg3
        500 => '#928374', // gray
        600 => '#7c6f64', // bg4 (dark)
        700 => '#665c54', // bg3
        800 => '#504945', // bg2
        850 => '#3c3836', // bg1
        900 => '#32302f', // bg0_s
        925 => '#282828', // bg0
        950 => '#1d2021', // bg0_h
    ];

    /** Gruvbox's faded accents, for a cream ground. */
    public const array LIGHT = [
        'red' => '#9d0006',
        'green' => '#79740e',
        'yellow' => '#b57614',
        'blue' => '#076678',
        'aqua' => '#427b58',
    ];

    /** Gruvbox's bright accents, for a dark ground. */
    public const array DARK = [
        'red' => '#fb4934',
        'green' => '#b8bb26',
        'yellow' => '#fabd2f',
        'blue' => '#83a598',
        'aqua' => '#8ec07c',
    ];

    /**
     * The `theme` preference. `custom` opens it in the theme picker's Custom
     * tab, where its colours can be changed.
     *
     * @return array{id: string, name: string, colors: array<string, string>}
     */
    public static function preference(): array
    {
        return ['id' => 'custom', 'name' => 'Gruvbox', 'colors' => self::colors()];
    }

    /**
     * @return array<string, string>
     */
    public static function colors(): array
    {
        $grays = collect(self::GRAYS)->mapWithKeys(fn (string $color, int $shade) => ["gray-{$shade}" => $color])->all();

        return [
            // Buttons and selections carry white text, so they keep the faded blue in both modes.
            'primary' => self::LIGHT['blue'],
            'ui-accent-bg' => self::LIGHT['blue'],
            'ui-accent-text' => self::LIGHT['blue'],
            'global-header-bg' => self::GRAYS[850],
            'body-bg' => self::GRAYS[150],
            'body-border' => 'transparent',
            'content-bg' => self::GRAYS[100],
            'content-border' => self::GRAYS[300],
            'progress-bar' => self::LIGHT['yellow'],
            'focus-outline' => self::LIGHT['aqua'],
            'switch-bg' => self::LIGHT['green'],
            'success' => self::LIGHT['green'],
            'danger' => self::LIGHT['red'],
            ...$grays,

            'dark-ui-accent-text' => self::DARK['blue'],
            'dark-global-header-bg' => self::GRAYS[950],
            'dark-body-bg' => self::GRAYS[950],
            'dark-body-border' => self::GRAYS[950],
            'dark-content-bg' => self::GRAYS[925],
            'dark-content-border' => self::GRAYS[850],
            'dark-progress-bar' => self::DARK['yellow'],
            'dark-focus-outline' => self::DARK['aqua'],
            'dark-switch-bg' => self::LIGHT['green'],
            'dark-success' => self::DARK['green'],
            'dark-danger' => self::DARK['red'],
        ];
    }
}
