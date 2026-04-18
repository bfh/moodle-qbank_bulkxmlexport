# moodle-qbank_bulkxmlexport

[![Latest Release](https://img.shields.io/github/v/release/bfh/moodle-qbank_bulkxmlexport?sort=semver&color=orange)](https://github.com/bfh/moodle-qbank_bulkxmlexport/releases)
[![Moodle Plugin CI](https://github.com/bfh/moodle-qbank_bulkxmlexport/actions/workflows/moodle-plugin-ci.yml/badge.svg)](https://github.com/bfh/moodle-qbank_bulkxmlexport/actions/workflows/moodle-plugin-ci.yml)
[![PHP Support](https://img.shields.io/badge/php-8.1--8.4-blue)](https://github.com/bfh/moodle-qbank_bulkxmlexport/actions)
[![Moodle Support](https://img.shields.io/badge/Moodle-5.0+-orange)](https://github.com/bfh/moodle-qbank_bulkxmlexport/actions)
[![License GPL-3.0](https://img.shields.io/github/license/bfh/moodle-qbank_bulkxmlexport?color=lightgrey)](https://github.com/bfh/moodle-qbank_bulkxmlexport/blob/main/LICENSE)
[![GitHub contributors](https://img.shields.io/github/contributors/bfh/moodle-qbank_bulkxmlexport)](https://github.com/bfh/moodle-qbank_bulkxmlexport/graphs/contributors)

Moodle question bank plugin to selectively download questions as Moodle XML.

This project was created at DevCamp at MoodleMoot DACH 2024.


## Requirements

This plugin requires Moodle 5.0.

This is the version for Moodle 5.0, if you have Moodle 4.4 or 4.5 please use version 0.4 of this plugin.

## Motivation for this report

Quiz question export as XML does only work category wise or for a single question only. This plugin adds a bulk action in the question bank. Questions remain where they are.
The export is an Moodle XML file.

## Installation

Install the plugin to folder `<moodle_dir>/question/bank/bulkxmlexport`

Then visit the admin notification page to complete the installation.

See http://docs.moodle.org/en/Installing_plugins for details on installing Moodle plugins

## Version History

### 0.7

- Add Mooodle 5.2 support.

### 0.6

- Add Mooodle 5.1 support.

### 0.5

- Add Moodle 5.0 support, drop support for Moodle 4.x because of
  signature changes in the hook funktion.
- Set maturity to stable.

### 0.4

- Add Moodle 4.5 to the CI pipeline.

### 0.3

- Fix missing include.

### 0.2

- Added ci of Moodle 4.4.
- Added basic behat tests for functionality.

### 0.1

First version after creating it at Moodle Moot DACH 24