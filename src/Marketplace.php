<?php

namespace JothamLec\EditorThemes;

use Illuminate\Support\Collection;
use Statamic\Marketplace\Marketplace as StatamicMarketplace;

/**
 * Preferences → Themes lists the themes the Statamic Marketplace returns, so
 * these are put first in that list.
 */
class Marketplace extends StatamicMarketplace
{
    public function themes(): Collection
    {
        return Themes::all()->map(fn (string $theme) => $theme::picker())->values()->concat(parent::themes());
    }
}
