<?php

use JothamLec\Gruvbox\Theme;
use Statamic\CP\Color;
use Statamic\Facades\User;

function contrast(string $a, string $b): float
{
    $luminance = function (string $hex): float {
        $channels = array_map(fn (string $pair) => hexdec($pair) / 255, str_split(ltrim($hex, '#'), 2));
        [$r, $g, $b] = array_map(fn (float $c) => $c <= 0.03928 ? $c / 12.92 : (($c + 0.055) / 1.055) ** 2.4, $channels);

        return 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
    };
    [$light, $dark] = [max($luminance($a), $luminance($b)), min($luminance($a), $luminance($b))];

    return ($light + 0.05) / ($dark + 0.05);
}

test('the theme sets every colour Statamic themes, in light mode and dark', function () {
    $colors = Theme::colors();

    expect(array_diff(array_keys(Color::defaults()), array_keys($colors)))->toBe([])
        ->and(array_diff(array_keys(Color::defaults(dark: true)), array_keys($colors)))->toBe([]);
});

test('the grey ramp is Gruvbox\'s neutrals, light to dark', function () {
    expect(Theme::GRAYS[50])->toBe('#f9f5d7')
        ->and(Theme::GRAYS[925])->toBe('#282828')
        ->and(Theme::GRAYS[950])->toBe('#1d2021');
});

test('text stays readable: white on the accent and the link colour at 4.5:1, status colours at 3:1', function () {
    $colors = Theme::colors();

    expect(contrast('#ffffff', $colors['ui-accent-bg']))->toBeGreaterThanOrEqual(4.5)
        ->and(contrast($colors['ui-accent-text'], $colors['content-bg']))->toBeGreaterThanOrEqual(4.5)
        ->and(contrast($colors['dark-ui-accent-text'], $colors['dark-content-bg']))->toBeGreaterThanOrEqual(4.5);

    // Success and danger mark badges, icons and field borders (3:1); Gruvbox's bright red is 4.3:1 on dark.
    foreach (['success', 'danger'] as $status) {
        expect(contrast($colors[$status], $colors['content-bg']))->toBeGreaterThanOrEqual(3)
            ->and(contrast($colors["dark-{$status}"], $colors['dark-content-bg']))->toBeGreaterThanOrEqual(3);
    }
});

test('applying it saves the theme in the user\'s preferences, which the control panel prints', function () {
    User::make()->email('jo@example.test')->makeSuper()->save();

    $this->artisan('statamic:gruvbox:apply')->assertSuccessful();

    $this->actingAs(User::findByEmail('jo@example.test'));

    expect(User::findByEmail('jo@example.test')->preferences()['theme'] ?? null)->toBe(Theme::preference())
        ->and(Color::cssVariables())->toContain('--theme-color-content-bg: #f9f5d7;')
        ->and(Color::cssVariables(dark: true))->toContain('--theme-color-content-bg: #282828;')
        ->and(Color::cssVariables(dark: true))->toContain('--theme-color-success: #b8bb26;');
});

test('it can be removed again, leaving Statamic\'s default', function () {
    tap(User::make()->email('jo@example.test')->setPreference('theme', Theme::preference()))->save();

    $this->artisan('statamic:gruvbox:apply', ['email' => 'jo@example.test', '--remove' => true])->assertSuccessful();

    expect(User::findByEmail('jo@example.test')->preferences()['theme'] ?? null)->toBeNull();
});

test('with several users it asks which; an unknown email fails', function () {
    User::make()->email('a@example.test')->save();
    User::make()->email('b@example.test')->save();

    $this->artisan('statamic:gruvbox:apply')->assertFailed();
    $this->artisan('statamic:gruvbox:apply', ['email' => 'nobody@example.test'])->assertFailed();
    $this->artisan('statamic:gruvbox:apply', ['email' => 'b@example.test'])->assertSuccessful();

    expect(User::findByEmail('b@example.test')->preferences()['theme'] ?? null)->toBe(Theme::preference())
        ->and(User::findByEmail('a@example.test')->preferences()['theme'] ?? null)->toBeNull();
});
