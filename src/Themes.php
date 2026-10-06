<?php

namespace JothamLec\EditorThemes;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

final class Themes
{
    /** @var list<class-string<Theme>> */
    public const array ALL = [
        Themes\Catppuccin::class,
        Themes\Dracula::class,
        Themes\Everforest::class,
        Themes\Gruvbox::class,
        Themes\Kanagawa::class,
        Themes\Nord::class,
        Themes\One::class,
        Themes\RosePine::class,
        Themes\Solarized::class,
        Themes\TokyoNight::class,
    ];

    /** @return Collection<string, class-string<Theme>> keyed by id */
    public static function all(): Collection
    {
        return collect(self::ALL)->keyBy(fn (string $theme) => $theme::id());
    }

    /** A theme by id or by name, e.g. `tokyo-night` or `Tokyo Night`. */
    public static function find(string $idOrName): ?string
    {
        return self::all()->get(Str::slug($idOrName));
    }
}
