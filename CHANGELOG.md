# Changelog

This is a fork of [jbboehr/phpstan-lost-in-translation](https://github.com/jbboehr/phpstan-lost-in-translation);
upstream history before the fork point is not tracked here.

## [Unreleased]

### Changed
- Raised minimum PHP version to 8.2 and Laravel to 12
  (and bumping all the deps minimum versions too)

## [0.1.0] - 2026-05-16

### Added
- `webmozart/assert` to `require-dev` so bladestan 0.6.0's undeclared transitive use of
  `Webmozart\Assert\Assert` works on Laravel 10.

### Changed
- Forked from `jbboehr/phpstan-lost-in-translation`; package vendor renamed to `mfn`,
  PHP namespace renamed to `Mfn\PHPStanLostInTranslation`.

### Removed
- Laravel 9 from CI matrix; composer audit blocks all L9 patches via two unfixable
  advisories and L9 is EOL upstream. `composer.json` constraint still allows L9 for
  consumers with their own audit config.
