<?php

namespace JothamLec\EditorThemes\Themes;

use JothamLec\EditorThemes\Theme;

/**
 * Dracula, with its official light variant, Alucard, in light mode. Dracula
 * has no blue, so links and buttons are its purple.
 */
final class Dracula extends Theme
{
    public const string NAME = 'Dracula';

    public const string SOURCE = 'https://draculatheme.com/spec';

    public const array LIGHT_GRAYS = [
        100 => '#fffbeb', // Alucard background
        150 => '#efeddc', // floating
        200 => '#dedccf', // bg light
        300 => '#ceccc0', // bg dark
        400 => '#bcbab3', // bg darker
        600 => '#6c664b', // comment
        800 => '#44475a', // Dracula selection
        850 => '#343746', // bg light
        900 => '#282a36', // background
        925 => '#21222c', // bg dark
        950 => '#191a21', // bg darker
    ];

    public const array DARK_GRAYS = [
        100 => '#f8f8f2', // foreground
        300 => '#b6b6b2', // Doom Emacs's base6
        500 => '#6272a4', // comment
        700 => '#44475a', // selection
        800 => '#424450', // bg lighter
        850 => '#343746', // bg light
        925 => '#282a36', // background
        950 => '#21222c', // bg dark
    ];

    public const array LIGHT = [
        'blue' => '#644ac9', // Alucard purple
        'green' => '#14710a',
        'red' => '#cb3a2a',
        'yellow' => '#846e15',
        'aqua' => '#036a96', // cyan
    ];

    public const array DARK = [
        'blue' => '#bd93f9', // purple
        'green' => '#50fa7b',
        'red' => '#ff5555',
        'yellow' => '#f1fa8c',
        'aqua' => '#8be9fd', // cyan
    ];
}
