<?php

namespace JothamLec\EditorThemes\Themes;

use JothamLec\EditorThemes\Theme;

/**
 * Nord in dark mode, and in light mode Snow Storm with the deeper accents
 * of Doom Emacs's Nord Light.
 */
final class Nord extends Theme
{
    public const string NAME = 'Nord';

    public const array LIGHT_GRAYS = [
        100 => '#eceff4', // nord6
        150 => '#e5e9f0', // nord5
        200 => '#d8dee9', // nord4
        400 => '#a1acc0', // Nord Light base6
        500 => '#60728c', // Nord Light base7
        600 => '#4c566a', // nord3
        700 => '#434c5e', // nord2
        800 => '#3b4252', // nord1
        850 => '#2e3440', // nord0
        925 => '#242832', // Nord base1
        950 => '#191c25', // base0
    ];

    public const array DARK_GRAYS = [
        50 => '#eceff4', // nord6
        100 => '#e5e9f0', // nord5
        200 => '#d8dee9', // nord4
        500 => '#9099ab', // Nord base6
        600 => '#4c566a', // nord3
        700 => '#434c5e', // nord2
        800 => '#3b4252', // nord1
        850 => '#373e4c', // base3
        925 => '#2e3440', // nord0
        950 => '#272c36', // bg-alt
    ];

    public const array LIGHT = [
        'blue' => '#3b6ea8',
        'green' => '#4f894c',
        'red' => '#99324b',
        'yellow' => '#9a7500',
        'aqua' => '#29838d',
    ];

    public const array DARK = [
        'blue' => '#88c0d0', // nord8
        'green' => '#a3be8c', // nord14
        'red' => '#bf616a', // nord11
        'yellow' => '#ebcb8b', // nord13
        'aqua' => '#8fbcbb', // nord7
    ];
}
