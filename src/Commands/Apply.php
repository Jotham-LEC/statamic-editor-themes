<?php

namespace JothamLec\Gruvbox\Commands;

use Illuminate\Console\Command;
use JothamLec\Gruvbox\Theme;
use Statamic\Console\RunsInPlease;
use Statamic\Contracts\Auth\User as UserContract;
use Statamic\Facades\User;

/**
 * `php please gruvbox:apply [email] [--remove]`: sets Gruvbox as a user's
 * control-panel theme. It is saved in that user's preferences, so it follows
 * them to every browser and device; Preferences → Themes changes it back.
 * Without an email, a site with one user applies it to that user.
 */
class Apply extends Command
{
    use RunsInPlease;

    protected $signature = 'statamic:gruvbox:apply {email? : The user to theme} {--remove : Remove the theme instead}';

    protected $description = 'Set Gruvbox as a user\'s control-panel theme';

    public function handle(): int
    {
        $user = $this->user();

        if (! $user) {
            return self::FAILURE;
        }

        if ($this->option('remove')) {
            $user->removePreference('theme')->save();
            $this->components->info("Removed the theme for {$user->email()}.");

            return self::SUCCESS;
        }

        $user->setPreference('theme', Theme::preference())->save();
        $this->components->info("Gruvbox is now the theme for {$user->email()}. Reload the control panel.");

        return self::SUCCESS;
    }

    private function user(): ?UserContract
    {
        if ($email = $this->argument('email')) {
            $user = User::findByEmail($email);
            $user ?? $this->components->error("No user has the email {$email}.");

            return $user;
        }

        $users = User::all();

        if ($users->count() !== 1) {
            $this->components->error('Name the user by email: this site has '.$users->count().' users.');

            return null;
        }

        return $users->first();
    }
}
