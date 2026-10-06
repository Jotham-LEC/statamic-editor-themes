<?php

namespace JothamLec\EditorThemes\Themes;

use JothamLec\EditorThemes\Theme;

/** Solarized: one palette, its base tones read from either end. */
final class Solarized extends Theme
{
    public const string NAME = 'Solarized';

    public const array LIGHT_GRAYS = [
        100 => '#fdf6e3', // base3
        150 => '#eee8d5', // base2
        300 => '#93a1a1', // base1
        400 => '#839496', // base0
        500 => '#586e75', // base01
        850 => '#073642', // base02
        950 => '#002b36', // base03
    ];

    public const array DARK_GRAYS = [
        50 => '#fdf6e3', // base3
        100 => '#eee8d5', // base2
        300 => '#93a1a1', // base1
        400 => '#839496', // base0
        500 => '#657b83', // base00
        600 => '#586e75', // base01
        850 => '#073642', // base02
        925 => '#002b36', // base03
        950 => '#00212b', // Doom Emacs's bg-alt
    ];

    public const array LIGHT = [
        'blue' => '#268bd2',
        'green' => '#859900',
        'red' => '#dc322f',
        'yellow' => '#b58900',
        'aqua' => '#2aa198', // cyan
    ];

    public const array DARK = self::LIGHT;
}
