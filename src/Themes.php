<?php

namespace JothamLec\EditorThemes;

use Illuminate\Support\Collection;

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

    /** @return class-string<Theme>|null */
    public static function find(string $id): ?string
    {
        return self::all()->get($id);
    }
}
