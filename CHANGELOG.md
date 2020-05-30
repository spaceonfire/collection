# Changelog

All notable changes to `collection` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

<!--
## [X.Y.Z] - YYYY-MM-DD
### Added
- Nothing

### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- Nothing

### Security
- Nothing
-->

## UNRELEASED
### Added
- Implement FilterableInterface from `spaceonfire/criteria` by collection
- Base collection decorator implementation
- `TypedCollection` acts as decorator
- More options for type check in `TypedCollection`
- New `IndexedCollection` decorator

## [1.3.0] - 2020-03-07
### Added
- New methods added:
    - `CollectionInterface::unique()`
    - `CollectionInterface::implode()`
    - `CollectionInterface::first()`
    - `CollectionInterface::last()`
    - `CollectionInterface::firstKey()`
    - `CollectionInterface::lastKey()`
    - `CollectionInterface::average()`
    - `CollectionInterface::median()`
- Method aliases added:
    - `BaseCollection::avg()` alias to `BaseCollection::average()`
    - `BaseCollection::join()` alias to `BaseCollection::implode()`

## [1.2.2] - 2020-03-07
### Fixed
- Declare `CollectionInterface::merge` attributes
- Fix example in README.md

## [1.2.1] - 2019-11-09
### Fixed
- Fix `BaseCollection::filter` call with empty callback

## [1.2.0] - 2019-11-08
### Added
- A huge update for `TypedCollection`:
    - check type on item add to collection
    - add `downgrade` method that returns simple `Collection` instance
    - override some methods witch logic requires downgrade, restore original `TypedCollection` when we can
    - cover `BaseCollection` and `TypedCollection` with tests

## [1.1.1] - 2019-10-18
### Fixed
- Fix checking class and interface existence in TypedCollection

## [1.1.0] - 2019-10-18
### Added
- Add TypedCollection
- Documentation generated

## [1.0.0] - 2019-10-03
### Added
- Base collection implementation
