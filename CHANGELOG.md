# Changelog

## v5.0.0

- Support Filament v5 and Laravel 12 / 13.
- Fix the developer gate page redirect using a wrong config key.
- Fall back to the configured redirect when there is no previous page to return to after unlocking.
- Add a test suite covering the gate page, middleware, logout action and install command.
