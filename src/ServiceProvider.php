<?php

namespace JothamLec\Gruvbox;

use JothamLec\Gruvbox\Commands\Apply;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $commands = [Apply::class];
}
