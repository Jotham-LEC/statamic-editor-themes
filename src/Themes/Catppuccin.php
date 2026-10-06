<?php

namespace JothamLec\EditorThemes\Themes;

use JothamLec\EditorThemes\Theme;

/** Catppuccin: Latte in light mode, Mocha in dark. */
final class Catppuccin extends Theme
{
    public const string NAME = 'Catppuccin';

    public const array LIGHT_GRAYS = [
        100 => '#eff1f5', // Latte base
        150 => '#e6e9ef', // mantle
        200 => '#dce0e8', // crust
        300 => '#ccd0da', // surface0
        400 => '#9ca0b0', // overlay0
        500 => '#7c7f93', // overlay2
        600 => '#5c5f77', // subtext1
        700 => '#4c4f69', // text
        850 => '#313244', // Mocha surface0
        900 => '#1e1e2e', // base
        925 => '#181825', // mantle
        950 => '#11111b', // crust
    ];

    public const array DARK_GRAYS = [
        100 => '#cdd6f4', // Mocha text
        200 => '#bac2de', // subtext1
        300 => '#a6adc8', // subtext0
        400 => '#9399b2', // overlay2
        500 => '#7f849c', // overlay1
        600 => '#6c7086', // overlay0
        700 => '#585b70', // surface2
        800 => '#45475a', // surface1
        850 => '#313244', // surface0
        925 => '#1e1e2e', // base
        950 => '#181825', // mantle
    ];

    public const array LIGHT = [
        'blue' => '#1e66f5',
        'green' => '#40a02b',
        'red' => '#d20f39',
        'yellow' => '#df8e1d',
        'aqua' => '#04a5e5', // sky
    ];

    public const array DARK = [
        'blue' => '#89b4fa',
        'green' => '#a6e3a1',
        'red' => '#f38ba8',
        'yellow' => '#f9e2af',
        'aqua' => '#89dceb', // sky
    ];
}
