<?php

namespace JothamLec\EditorThemes;

use Illuminate\Support\Collection;
use Statamic\Marketplace\Marketplace as StatamicMarketplace;
use Throwable;

/**
 * Preferences → Themes lists the themes the Statamic Marketplace returns, so
 * these are put first in that list.
 */
class Marketplace extends StatamicMarketplace
{
    public function themes(): Collection
    {
        // Statamic catches only HTTP errors, so a site that can't reach statamic.com
        // (offline, firewalled, DNS down) would otherwise lose these themes too.
        try {
            $marketplace = parent::themes();
        } catch (Throwable) {
            $marketplace = collect();
        }

        return Themes::all()->map(fn (string $theme) => $theme::picker())->values()->concat($marketplace);
    }
}
