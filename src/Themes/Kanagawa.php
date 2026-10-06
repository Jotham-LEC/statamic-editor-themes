<?php

namespace JothamLec\EditorThemes\Themes;

use JothamLec\EditorThemes\Theme;

/** Kanagawa: Lotus in light mode, Wave in dark. */
final class Kanagawa extends Theme
{
    public const string NAME = 'Kanagawa';

    public const array LIGHT_GRAYS = [
        100 => '#f2ecbc', // lotusWhite3
        150 => '#e5ddb0', // lotusWhite2
        200 => '#dcd5ac', // lotusWhite1
        300 => '#d5cea3', // lotusWhite0
        400 => '#8a8980', // lotusGray3
        500 => '#716e61', // lotusGray2
        600 => '#545464', // lotusInk1
        700 => '#43436c', // lotusInk2
        850 => '#2a2a37', // Wave sumiInk4
        900 => '#1f1f28', // sumiInk3
        950 => '#16161d', // sumiInk0
    ];

    public const array DARK_GRAYS = [
        100 => '#dcd7ba', // fujiWhite
        200 => '#c8c093', // oldWhite
        400 => '#938aa9', // springViolet1
        500 => '#727169', // fujiGray
        600 => '#54546d', // sumiInk6
        800 => '#363646', // sumiInk5
        850 => '#2a2a37', // sumiInk4
        925 => '#1f1f28', // sumiInk3
        950 => '#16161d', // sumiInk0
    ];

    public const array LIGHT = [
        'blue' => '#4d699b', // lotusBlue4
        'green' => '#6f894e', // lotusGreen
        'red' => '#c84053', // lotusRed
        'yellow' => '#de9800', // lotusYellow3
        'aqua' => '#597b75', // lotusAqua
    ];

    public const array DARK = [
        'blue' => '#7e9cd8', // crystalBlue
        'green' => '#98bb6c', // springGreen
        'red' => '#ff5d62', // peachRed
        'yellow' => '#e6c384', // carpYellow
        'aqua' => '#7aa89f', // waveAqua2
    ];
}
