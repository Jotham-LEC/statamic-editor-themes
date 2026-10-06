<?php

namespace JothamLec\EditorThemes\Themes;

use JothamLec\EditorThemes\Theme;

/** Tokyo Night: Day in light mode, Night in dark. */
final class TokyoNight extends Theme
{
    public const string NAME = 'Tokyo Night';

    public const array LIGHT_GRAYS = [
        100 => '#e1e2e7', // Day bg
        150 => '#d0d5e3', // bg_dark
        200 => '#c4c8da', // bg_highlight
        300 => '#a8aecb', // fg_gutter
        400 => '#848cb5', // comment
        500 => '#68709a', // dark5
        600 => '#414868', // Night terminal_black
        800 => '#3b4261', // Night fg_gutter
        850 => '#292e42', // bg_highlight
        900 => '#1a1b26', // bg
        925 => '#16161e', // bg_dark
        950 => '#0c0e14', // bg_dark1
    ];

    public const array DARK_GRAYS = [
        50 => '#c0caf5', // Night fg
        100 => '#a9b1d6', // fg_dark
        500 => '#737aa2', // dark5
        600 => '#565f89', // comment
        700 => '#414868', // terminal_black
        800 => '#3b4261', // fg_gutter
        850 => '#292e42', // bg_highlight
        925 => '#1a1b26', // bg
        950 => '#16161e', // bg_dark
    ];

    public const array LIGHT = [
        'blue' => '#2e7de9',
        'green' => '#587539',
        'red' => '#f52a65',
        'yellow' => '#8c6c3e',
        'aqua' => '#007197', // cyan
    ];

    public const array DARK = [
        'blue' => '#7aa2f7',
        'green' => '#9ece6a',
        'red' => '#f7768e',
        'yellow' => '#e0af68',
        'aqua' => '#7dcfff', // cyan
    ];

    public const ?string BUTTON = '#3d59a1'; // Night blue0
}
