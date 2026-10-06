# statamic-gruvbox

[Gruvbox](https://github.com/morhetz/gruvbox), light and dark, for the Statamic 6 control panel. Works on Statamic Core.

Private package (`jotham-lec/statamic-gruvbox`).

## Install

```json
"repositories": [{ "type": "vcs", "url": "https://github.com/Jotham-LEC/statamic-gruvbox" }]
```

```bash
composer require jotham-lec/statamic-gruvbox
php please gruvbox:apply              # the only user; or name one: gruvbox:apply jo@example.com
```

Reload the control panel. The theme is saved in that user's preferences, in the site's user store, so it follows them to every browser and device. Preferences → Themes shows it under Custom, where its colours can be changed, and where another theme can be picked. `php please gruvbox:apply --remove` goes back to Statamic's default.

Statamic Core keeps a theme per user; a default theme for everyone, or per role, needs Pro.

## The colours

`src/Theme.php`. Statamic's grey ramp (50 to 950) is Gruvbox's fourteen neutrals, from a near-white cream (`#fdfcf5`, which keeps Statamic's white-to-`gray-50` button gradients faint) to dark `bg0_h` `#1d2021`, and serves both modes. Accents are Gruvbox's faded colours on cream and its bright ones on dark: blue for buttons and links, green for success and switches, red for danger, yellow for the progress bar, aqua for focus. Buttons keep the faded blue in dark mode, as they carry white text.

## Develop

```bash
composer install
vendor/bin/pest
vendor/bin/pint
```

Release: `git tag -a vX.Y.Z -m vX.Y.Z && git push --tags`.

Licence: proprietary, all rights reserved.
