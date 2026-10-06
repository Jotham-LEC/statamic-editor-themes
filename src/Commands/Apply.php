<?php

namespace JothamLec\EditorThemes\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use JothamLec\EditorThemes\Themes;
use Statamic\Console\RunsInPlease;

use function Laravel\Prompts\select;

/**
 * `php please editor-themes:apply {theme} [email]`: sets a theme as a user's
 * control-panel theme, as picking it in Preferences → Themes would. Without
 * an email, a site with one user applies it to that user.
 */
class Apply extends Command implements PromptsForMissingInput
{
    use FindsUser, RunsInPlease;

    protected $signature = 'statamic:editor-themes:apply {theme : The theme, e.g. gruvbox or "Tokyo Night"} {email? : The user to theme}';

    protected $description = 'Set a user\'s control-panel theme';

    public function handle(): int
    {
        $theme = Themes::find($this->argument('theme'));

        if (! $theme) {
            $this->components->error('No theme is called '.$this->argument('theme').'. The themes: '.Themes::all()->keys()->implode(', ').'.');

            return self::FAILURE;
        }

        if (! $user = $this->user()) {
            return self::FAILURE;
        }

        $user->setPreference('theme', $theme::preference())->save();
        $this->components->info($theme::NAME." is now the theme for {$user->email()}. Reload the control panel.");

        return self::SUCCESS;
    }

    protected function promptForMissingArgumentsUsing(): array
    {
        return ['theme' => fn () => select('Which theme?', Themes::all()->map(fn (string $theme) => $theme::NAME)->all())];
    }
}
