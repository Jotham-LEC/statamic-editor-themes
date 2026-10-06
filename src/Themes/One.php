<?php

namespace JothamLec\EditorThemes\Themes;

use JothamLec\EditorThemes\Theme;

/** Atom's One: One Light in light mode, One Dark in dark, as Doom Emacs has them. */
final class One extends Theme
{
    public const string NAME = 'One';

    public const string SOURCE = 'https://github.com/doomemacs/themes';

    public const array LIGHT_GRAYS = [
        100 => '#fafafa', // One Light bg
        150 => '#f0f0f0', // bg-alt
        200 => '#e7e7e7', // base1
        300 => '#c6c7c7', // base3
        400 => '#9ca0a4', // base4
        500 => '#696c77', // mono-2
        700 => '#383a42', // fg
        850 => '#282c34', // One Dark bg
        900 => '#21242b', // bg-alt
        950 => '#1b2229', // base0
    ];

    public const array DARK_GRAYS = [
        50 => '#dfdfdf', // base8
        100 => '#bbc2cf', // fg
        400 => '#9ca0a4', // base7
        500 => '#73797e', // base6
        600 => '#5b6268', // base5
        800 => '#3f444a', // base4
        925 => '#282c34', // bg
        950 => '#21242b', // bg-alt
    ];

    public const array LIGHT = [
        'blue' => '#4078f2',
        'green' => '#50a14f',
        'red' => '#e45649',
        'yellow' => '#986801',
        'aqua' => '#0184bc', // cyan
    ];

    public const array DARK = [
        'blue' => '#51afef',
        'green' => '#98be65',
        'red' => '#ff6c6b',
        'yellow' => '#ecbe7b',
        'aqua' => '#46d9ff', // cyan
    ];
}
