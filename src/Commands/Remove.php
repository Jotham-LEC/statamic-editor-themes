<?php

namespace JothamLec\EditorThemes\Commands;

use Illuminate\Console\Command;
use Statamic\Console\RunsInPlease;

/**
 * `php please editor-themes:remove [email]`: removes a user's own theme, so
 * they see the site's default (on Pro, their role's or the site's, if set).
 */
class Remove extends Command
{
    use FindsUser, RunsInPlease;

    protected $signature = 'statamic:editor-themes:remove {email? : The user}';

    protected $description = 'Remove a user\'s control-panel theme, leaving the site\'s default';

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
