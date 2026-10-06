<?php

namespace JothamLec\EditorThemes\Themes;

use JothamLec\EditorThemes\Theme;

/** Everforest, light and dark, at medium contrast. */
final class Everforest extends Theme
{
    public const string NAME = 'Everforest';

    public const string SOURCE = 'https://github.com/sainnhe/everforest';

    public const array LIGHT_GRAYS = [
        100 => '#fdf6e3', // light bg0
        150 => '#f4f0d9', // bg1
        200 => '#efebd4', // bg2
        300 => '#e0dcc7', // bg4
        400 => '#bdc3af', // bg5
        500 => '#829181', // grey2
        600 => '#5c6a72', // fg
        850 => '#343f44', // dark bg1
        900 => '#2d353b', // bg0
        950 => '#232a2e', // bg_dim
    ];

    public const array DARK_GRAYS = [
        100 => '#d3c6aa', // dark fg
        400 => '#9da9a0', // grey2
        500 => '#859289', // grey1
        600 => '#7a8478', // grey0
        700 => '#56635f', // bg5
        800 => '#475258', // bg3
        850 => '#3d484d', // bg2
        900 => '#343f44', // bg1
        925 => '#2d353b', // bg0
        950 => '#232a2e', // bg_dim
    ];

    public const array LIGHT = [
        'blue' => '#3a94c5',
        'green' => '#8da101',
        'red' => '#f85552',
        'yellow' => '#dfa000',
        'aqua' => '#35a77c',
    ];

    public const array DARK = [
        'blue' => '#7fbbb3',
        'green' => '#a7c080',
        'red' => '#e67e80',
        'yellow' => '#dbbc7f',
        'aqua' => '#83c092',
    ];
}
