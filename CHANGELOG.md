# Change Log

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](http://semver.org/).

## [v0.2.0](https://github.com/graze/queue/compare/v0.1.1...v0.2.0)

### Added

* `purge` method to `ProducerInterface`

### Updated

* Updated `SqsAdapter` to support version 3.0 of the `aws/aws-sdk-php` dependency

### Fixed

* Fixed an `OutOfBoundsException` in `ArrayAdapter` thrown when calling dequeue on an empty array

## [v0.1.1](https://github.com/graze/queue/compare/v0.1.0...v0.1.1)

### Fixed

* Change `licence` to `license` in composer.json

## [v0.1.0](https://github.com/graze/queue/tree/v0.1.0)

### Added

* `Graze\Queue` project :balloon:
* Adapter `Graze\Queue\Adapter\ArrayAdapter`
* Adapter `Graze\Queue\Adapter\SqsAdapter`
