<?php

namespace JothamLec\Gruvbox;

use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewInstance;
use JothamLec\Gruvbox\Commands\Apply;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $commands = [Apply::class];

    public function bootAddon(): void
    {
        // Statamic loads an addon's stylesheet for everyone, so the button styles
        // go into the control panel's head only for someone using the theme.
        View::composer('statamic::partials.head', function (ViewInstance $view) {
            if (Theme::isActive()) {
                $view->getFactory()->startPush('head', '<style id="gruvbox">'.Theme::css().'</style>');
            }
        });
    }
}
