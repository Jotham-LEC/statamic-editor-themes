<?php

namespace JothamLec\EditorThemes;

use Illuminate\Support\Str;

/**
 * An editor colour scheme as a Statamic control-panel theme: a light variant
 * and a dark one, each a grey ramp and five accents.
 *
 * Statamic's grey ramp runs from the lightest shade (50) to the darkest (950)
 * in both modes. In light mode the page sits near the light end, in dark mode
 * near the dark end, and the text at the other. Each variant places its
 * palette's neutrals at the shades they suit, and Ramp mixes the rest.
 *
 * The accents are `blue` for links, `green` for success and switches, `red`
 * for danger, `yellow` for the progress bar and `aqua` for focus, each the
 * palette's nearest colour, and Contrast takes any too pale to read darker,
 * measured against the page's darker ground in light mode (the body around
 * the content) and its lighter one in dark mode (the content).
 * Buttons carry white text, so they take the light variant's blue in both
 * modes, or `BUTTON`.
 */
abstract class Theme
{
    public const string NAME = '';

    /** @var array<int, string> */
    public const array LIGHT_GRAYS = [];

    /** @var array<int, string> */
    public const array DARK_GRAYS = [];

    /** @var array{blue: string, green: string, red: string, yellow: string, aqua: string} */
    public const array LIGHT = [];

    /** @var array{blue: string, green: string, red: string, yellow: string, aqua: string} */
    public const array DARK = [];

    /** The button colour, under white text; the light blue unless set. */
    public const ?string BUTTON = null;

    public static function id(): string
    {
        return Str::slug(static::NAME);
    }

    /**
     * The `theme` preference, as the control panel's theme picker saves it.
     *
     * @return array{id: string, name: string, colors: array<string, string>}
     */
    public static function preference(): array
    {
        return ['id' => static::id(), 'name' => static::NAME, 'colors' => static::colors()];
    }

    /**
     * The theme as the theme picker lists it, dark colours without their prefix.
     *
     * @return array{id: string, name: string, author: string, colors: array<string, string>, darkColors: array<string, string>}
     */
    public static function picker(): array
    {
        [$dark, $light] = collect(static::colors())->partition(fn (string $color, string $key) => str_starts_with($key, 'dark-'));

        return [
            'id' => static::id(),
            'name' => static::NAME,
            'author' => 'Editor Themes',
            'colors' => $light->all(),
            'darkColors' => $dark->mapWithKeys(fn (string $color, string $key) => [substr($key, 5) => $color])->all(),
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function colors(): array
    {
        // Unless a theme sets it, gray-50 is the 100 shade most of the way to white: in
        // light mode Statamic's buttons and dropdowns fade from white to it, so it stays near white.
        $light = Ramp::fill(static::LIGHT_GRAYS, toWhite: 0.75);
        $dark = Ramp::fill(static::DARK_GRAYS, toWhite: 0.5);
        [$l, $d] = [static::LIGHT, static::DARK];
        [$ground, $darkGround] = [$light[150], $dark[925]];

        // Text at 4.5:1; switches, status colours and the focus ring at 3:1.
        $button = Contrast::ensure(static::BUTTON ?? $l['blue'], '#ffffff', 4.5);
        $switch = Contrast::ensure($l['green'], '#ffffff', 3);

        return [
            'primary' => $button,
            'ui-accent-bg' => $button,
            'ui-accent-text' => Contrast::ensure($l['blue'], $ground, 4.5),
            'global-header-bg' => $light[850],
            // body-border is left at Statamic's default, transparent, as the picker would save it.
            'body-bg' => $ground,
            'content-bg' => $light[100],
            'content-border' => $light[300],
            'progress-bar' => $l['yellow'],
            'focus-outline' => Contrast::ensure($l['aqua'], $ground, 3),
            'switch-bg' => $switch,
            'success' => Contrast::ensure($l['green'], $ground, 3),
            'danger' => Contrast::ensure($l['red'], $ground, 3),
            ...collect($light)->mapWithKeys(fn (string $color, int $shade) => ["gray-{$shade}" => $color]),

            'dark-ui-accent-text' => Contrast::ensure($d['blue'], $darkGround, 4.5),
            'dark-global-header-bg' => $dark[950],
            'dark-body-bg' => $dark[950],
            'dark-body-border' => $dark[950],
            'dark-content-bg' => $darkGround,
            'dark-content-border' => $dark[850],
            'dark-progress-bar' => $d['yellow'],
            'dark-focus-outline' => Contrast::ensure($d['aqua'], $darkGround, 3),
            // Switches carry a white knob in both modes.
            'dark-switch-bg' => $switch,
            'dark-success' => Contrast::ensure($d['green'], $darkGround, 3),
            'dark-danger' => Contrast::ensure($d['red'], $darkGround, 3),
            ...collect($dark)->mapWithKeys(fn (string $color, int $shade) => ["dark-gray-{$shade}" => $color]),
        ];
    }
}
