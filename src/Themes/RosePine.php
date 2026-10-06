<?php

namespace JothamLec\EditorThemes\Themes;

use JothamLec\EditorThemes\Theme;

/**
 * Rosé Pine: Dawn in light mode, the main variant in dark. It has no blue or
 * green: links are pine on Dawn and iris on dark, success is foam.
 */
final class RosePine extends Theme
{
    public const string NAME = 'Rosé Pine';

    public const string SOURCE = 'https://rosepinetheme.com';

    public const array LIGHT_GRAYS = [
        50 => '#fffaf3', // Dawn surface
        100 => '#faf4ed', // base
        150 => '#f2e9e1', // overlay
        200 => '#dfdad9', // highlight med
        300 => '#cecacd', // highlight high
        400 => '#9893a5', // muted
        500 => '#797593', // subtle
        700 => '#575279', // text
        850 => '#26233a', // main overlay
        900 => '#1f1d2e', // surface
        950 => '#191724', // base
    ];

    public const array DARK_GRAYS = [
        100 => '#e0def4', // text
        400 => '#908caa', // subtle
        600 => '#6e6a86', // muted
        700 => '#524f67', // highlight high
        800 => '#403d52', // highlight med
        850 => '#26233a', // overlay
        925 => '#1f1d2e', // surface
        950 => '#191724', // base
    ];

    public const array LIGHT = [
        'blue' => '#286983', // pine
        'green' => '#56949f', // foam
        'red' => '#b4637a', // love
        'yellow' => '#ea9d34', // gold
        'aqua' => '#907aa9', // iris
    ];

    public const array DARK = [
        'blue' => '#c4a7e7', // iris
        'green' => '#9ccfd8', // foam
        'red' => '#eb6f92', // love
        'yellow' => '#f6c177', // gold
        'aqua' => '#ebbcba', // rose
    ];
}
