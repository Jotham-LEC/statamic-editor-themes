# Changelog

## 1.0.0 – 2026-10-06

Now **Editor Themes**, `jotham-lec/statamic-editor-themes`, open source under the MIT licence.

### Added
- Nine more themes, each with a light and a dark version: Catppuccin, Dracula, Everforest, Kanagawa, Nord, One, Rosé Pine, Solarized and Tokyo Night, along with Gruvbox.
- The themes appear in Statamic's theme picker (Preferences → Themes), ahead of the Marketplace's themes. On Pro they can be saved as the default for everyone or for a role.
- Each version has its own grey ramp, so dark mode uses the dark palette's neutrals and is no longer the light ramp read backwards.
- Accents too light to read are darkened, or in dark mode lightened, only as far as needed: text reaches 4.5:1, and status colours, switches and focus reach 3:1. The tests check this for every theme.

### Changed
- The package, namespace (`JothamLec\EditorThemes`) and commands are renamed. `php please gruvbox:apply [email]` is now `php please editor-themes:apply gruvbox [email]`, and `--remove` is now `php please editor-themes:remove [email]`.
- Gruvbox's light-mode greys from `gray-600` down are a step darker, so muted text reaches 4.5:1. A saved theme is now stored under its own id (`gruvbox`) instead of `custom`, so the picker shows it selected.

### Upgrading from statamic-gruvbox
`composer remove jotham-lec/statamic-gruvbox && composer require jotham-lec/statamic-editor-themes`. A saved Gruvbox theme keeps working, because its colours are stored in the preference. Pick Gruvbox again, or run `php please editor-themes:apply gruvbox`, to get the new colours.

## 0.3.0 – 2026-10-06

### Changed
- Back to Statamic's convention, a theme of colours only: the button stylesheet is gone, and Statamic's own gradients stay. `gray-50` is a near-white cream (`#fdfcf5`) so they stay faint, and the main area is Gruvbox's `bg0` cream. Rerun `php please gruvbox:apply`: the colours are copied into the preference.

## 0.2.0 – 2026-10-06

### Changed
- Buttons are solid Gruvbox fills with their border: no gradient, gloss or drop shadow. The styles go into the control panel only for someone using the theme.

## 0.1.0 – 2026-10-06

First release: Gruvbox light and dark as a control-panel theme, and `php please gruvbox:apply [email] [--remove]` to set it in a user's preferences.
