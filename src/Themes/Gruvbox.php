<?php

namespace JothamLec\EditorThemes\Themes;

use JothamLec\EditorThemes\Theme;

/**
 * Gruvbox's light and dark draw on the same neutrals, cream to bg0_h: in
 * light mode the cream end is the page and the dark end the text, in dark
 * mode the other way round. The accents are its faded colours on cream, its
 * bright ones on dark.
 */
final class Gruvbox extends Theme
{
    public const string NAME = 'Gruvbox';

    public const string SOURCE = 'https://github.com/morhetz/gruvbox';

    public const array LIGHT_GRAYS = [
        // bg0 three quarters of the way to white: Statamic's buttons and
        // dropdowns fade from white to gray-50, so this keeps the fade faint.
        50 => '#fdfcf5',
        100 => '#fbf1c7', // bg0
        150 => '#f2e5bc', // bg0_s
        200 => '#ebdbb2', // bg1
        300 => '#d5c4a1', // bg2
        400 => '#bdae93', // bg3
        500 => '#928374', // gray
        600 => '#665c54', // bg3 (dark)
        700 => '#504945', // bg2
        800 => '#3c3836', // bg1
        850 => '#32302f', // bg0_s
        900 => '#282828', // bg0
        950 => '#1d2021', // bg0_h
    ];

    public const array DARK_GRAYS = [
        50 => '#fbf1c7', // fg0
        100 => '#ebdbb2', // fg1
        200 => '#d5c4a1', // fg2
        300 => '#bdae93', // fg3
        400 => '#a89984', // fg4
        500 => '#928374', // gray
        600 => '#7c6f64', // bg4
        700 => '#665c54', // bg3
        800 => '#504945', // bg2
        850 => '#3c3836', // bg1
        900 => '#32302f', // bg0_s
        925 => '#282828', // bg0
        950 => '#1d2021', // bg0_h
    ];

    public const array LIGHT = [
        'blue' => '#076678',
        'green' => '#79740e',
        'red' => '#9d0006',
        'yellow' => '#b57614',
        'aqua' => '#427b58',
    ];

    public const array DARK = [
        'blue' => '#83a598',
        'green' => '#b8bb26',
        'red' => '#fb4934',
        'yellow' => '#fabd2f',
        'aqua' => '#8ec07c',
    ];
}
