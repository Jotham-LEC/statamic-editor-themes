<?php

namespace JothamLec\EditorThemes\Commands;

use Illuminate\Console\Command;
use Statamic\Console\RunsInPlease;

/** `php please editor-themes:remove [email]`: back to Statamic's default theme. */
class Remove extends Command
{
    use FindsUser, RunsInPlease;

    protected $signature = 'statamic:editor-themes:remove {email? : The user}';

    protected $description = 'Remove a user\'s control-panel theme, leaving Statamic\'s default';

    public function handle(): int
    {
        if (! $user = $this->user()) {
            return self::FAILURE;
        }

        $user->removePreference('theme')->save();
        $this->components->info("Removed the theme for {$user->email()}.");

        return self::SUCCESS;
    }
}
