# Changelog

## 0.3.0 – 2026-10-06

### Changed
- Back to Statamic's convention, a theme of colours only: the button stylesheet is gone, and Statamic's own gradients stay. `gray-50` is a near-white cream (`#fdfcf5`) so they stay faint, and the main area is Gruvbox's `bg0` cream. Rerun `php please gruvbox:apply`: the colours are copied into the preference.

## 0.2.0 – 2026-10-06

### Changed
- Buttons are solid Gruvbox fills with their border: no gradient, gloss or drop shadow. The styles go into the control panel only for someone using the theme.

## 0.1.0 – 2026-10-06

First release: Gruvbox light and dark as a control-panel theme, and `php please gruvbox:apply [email] [--remove]` to set it in a user's preferences.
