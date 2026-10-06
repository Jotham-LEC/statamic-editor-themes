<?php

namespace JothamLec\EditorThemes;

use JothamLec\EditorThemes\Commands\Apply;
use JothamLec\EditorThemes\Commands\Remove;
use Statamic\Marketplace\Marketplace as StatamicMarketplace;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $commands = [Apply::class, Remove::class];

    public function register(): void
    {
        parent::register();

        $this->app->bind(StatamicMarketplace::class, Marketplace::class);
    }
}
