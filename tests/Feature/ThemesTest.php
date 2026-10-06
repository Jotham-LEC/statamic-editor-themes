<?php

use Illuminate\Support\Facades\Cache;
use JothamLec\EditorThemes\Ramp;
use JothamLec\EditorThemes\Themes;
use JothamLec\EditorThemes\Themes\Gruvbox;
use Statamic\CP\Color;
use Statamic\Facades\User;

function luminance(string $hex): float
{
    $channels = array_map(fn (string $pair) => hexdec($pair) / 255, str_split(ltrim($hex, '#'), 2));
    [$r, $g, $b] = array_map(fn (float $c) => $c <= 0.03928 ? $c / 12.92 : (($c + 0.055) / 1.055) ** 2.4, $channels);

    return 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
}

function contrast(string $a, string $b): float
{
    [$light, $dark] = [max(luminance($a), luminance($b)), min(luminance($a), luminance($b))];

    return ($light + 0.05) / ($dark + 0.05);
}

dataset('themes', fn () => Themes::all()->all());

test('every theme sets every colour Statamic themes, in light mode and dark, as hex', function (string $theme) {
    $colors = $theme::colors();

    expect(array_values(array_diff(array_keys(Color::defaults()), array_keys($colors))))->toBe(['body-border'])
        ->and(array_diff(array_keys(Color::defaults(dark: true)), array_keys($colors)))->toBe([]);

    foreach (Ramp::SHADES as $shade) {
        expect($colors)->toHaveKey("dark-gray-{$shade}");
    }

    // body-border is left at Statamic's default, as the picker saves it.
    expect($colors)->not->toHaveKey('body-border');

    foreach ($colors as $color) {
        expect($color)->toMatch('/^#[0-9a-f]{6}$/');
    }
})->with('themes');

test('each grey ramp runs from light to dark', function (string $theme) {
    $colors = $theme::colors();

    foreach (['gray', 'dark-gray'] as $ramp) {
        $luminances = array_map(fn (int $shade) => luminance($colors["{$ramp}-{$shade}"]), Ramp::SHADES);
        $sorted = $luminances;
        rsort($sorted);

        expect($luminances)->toBe($sorted);
    }
})->with('themes');

test('text reads at 4.5:1, and status colours, switches, focus and muted text at 3:1, on the content and the body around it, in both modes', function (string $theme) {
    $c = $theme::colors();

    expect(contrast('#ffffff', $c['ui-accent-bg']))->toBeGreaterThanOrEqual(4.5)
        ->and(contrast('#ffffff', $c['switch-bg']))->toBeGreaterThanOrEqual(3);

    foreach ([[$c['content-bg'], $c['body-bg'], ''], [$c['dark-content-bg'], $c['dark-body-bg'], 'dark-']] as [$content, $body, $mode]) {
        [$text, $muted] = $mode ? ['dark-gray-400', 'dark-gray-500'] : ['gray-600', 'gray-500'];

        foreach ([$content, $body] as $ground) {
            expect(contrast($c["{$mode}ui-accent-text"], $ground))->toBeGreaterThanOrEqual(4.5)
                ->and(contrast($c[$text], $ground))->toBeGreaterThanOrEqual(4.5)
                ->and(contrast($c[$muted], $ground))->toBeGreaterThanOrEqual(3);

            foreach (['success', 'danger', 'focus-outline'] as $role) {
                expect(contrast($c["{$mode}{$role}"], $ground))->toBeGreaterThanOrEqual(3);
            }
        }
    }
})->with('themes');

test('a grey ramp without its ends is refused, not half-filled', function () {
    Ramp::fill([100 => '#ffffff', 900 => '#000000'], toWhite: 0.75);
})->throws(InvalidArgumentException::class);

test('the theme picker still lists the themes when statamic.com can\'t be reached', function () {
    putenv('STATAMIC_DOMAIN=http://127.0.0.1:9');
    User::make()->email('jo@example.test')->makeSuper()->save();

    try {
        $themes = $this->actingAs(User::findByEmail('jo@example.test'))->getJson('/cp/themes')->assertOk()->json();
    } finally {
        putenv('STATAMIC_DOMAIN');
    }

    expect(collect($themes)->pluck('id')->all())->toBe(Themes::all()->keys()->all());
});

test('the theme picker lists the themes ahead of the Marketplace\'s', function () {
    Cache::put('marketplace-cp-themes', collect([['id' => 1, 'name' => 'Peak', 'author' => 'Rob de Kort', 'colors' => [], 'darkColors' => []]]));
    User::make()->email('jo@example.test')->makeSuper()->save();

    $themes = $this->actingAs(User::findByEmail('jo@example.test'))->getJson('/cp/themes')->assertOk()->json();

    expect(collect($themes)->pluck('id')->all())->toBe([...Themes::all()->keys(), 1])
        ->and($themes[0]['darkColors']['content-bg'])->toBe(Themes::all()->first()::colors()['dark-content-bg']);
});

test('applying a theme saves it in the user\'s preferences as the picker would, and the control panel prints it', function () {
    User::make()->email('jo@example.test')->makeSuper()->save();

    $this->artisan('statamic:editor-themes:apply', ['theme' => 'gruvbox'])->assertSuccessful();

    $this->actingAs(User::findByEmail('jo@example.test'));

    expect(User::findByEmail('jo@example.test')->preferences()['theme'] ?? null)->toBe(Gruvbox::preference())
        ->and(Color::cssVariables())->toContain('--theme-color-content-bg: #fbf1c7;')
        ->and(Color::cssVariables(dark: true))->toContain('--theme-color-content-bg: #282828;')
        ->and(Color::cssVariables(dark: true))->toContain('--theme-color-gray-50: #fbf1c7;')
        ->and(Color::cssVariables(dark: true))->toContain('--theme-color-success: #b8bb26;');
});

test('a theme can be named by its name as well as its id', function () {
    User::make()->email('jo@example.test')->save();

    $this->artisan('statamic:editor-themes:apply', ['theme' => 'Tokyo Night'])->assertSuccessful();

    expect(User::findByEmail('jo@example.test')->preferences()['theme']['id'])->toBe('tokyo-night');
});

test('an unknown theme fails, naming the themes', function () {
    User::make()->email('jo@example.test')->save();

    $this->artisan('statamic:editor-themes:apply', ['theme' => 'vaporwave'])
        ->expectsOutputToContain('catppuccin, dracula')
        ->assertFailed();
});

test('it can be removed again, leaving Statamic\'s default', function () {
    tap(User::make()->email('jo@example.test')->setPreference('theme', Gruvbox::preference()))->save();

    $this->artisan('statamic:editor-themes:remove', ['email' => 'jo@example.test'])->assertSuccessful();

    expect(User::findByEmail('jo@example.test')->preferences()['theme'] ?? null)->toBeNull();
});

test('with several users it needs an email; an unknown email fails', function () {
    User::make()->email('a@example.test')->save();
    User::make()->email('b@example.test')->save();

    $this->artisan('statamic:editor-themes:apply', ['theme' => 'dracula'])->assertFailed();
    $this->artisan('statamic:editor-themes:apply', ['theme' => 'dracula', 'email' => 'nobody@example.test'])->assertFailed();
    $this->artisan('statamic:editor-themes:apply', ['theme' => 'dracula', 'email' => 'b@example.test'])->assertSuccessful();

    expect(User::findByEmail('b@example.test')->preferences()['theme']['id'] ?? null)->toBe('dracula')
        ->and(User::findByEmail('a@example.test')->preferences()['theme'] ?? null)->toBeNull();
});
