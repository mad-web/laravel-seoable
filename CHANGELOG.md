# Changelog

All Notable changes to `laravel-seoable` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## 1.2.0 - 2018-04-30
- Laravel 5.6 support
- Fixed saving custom seo data into database
- Added more testcases
- CI configs updated

## 1.1.4 - 2017-10-23
- Made `open_graph` and `twitter` field in seo data table as nullable 
- Implemented cascade deleting for related seo data

## 1.1.3 - 2017-10-23
- Changed relation type of `seoData` to morphOne
- Fixed error when seo data not exists for a model in database

## 1.1.2 - 2017-10-18
- Fixed seo data creation for non existing model

## 1.1.1 - 2017-10-18
- Removed dependency from `trans` helper
- Declare templates for translatable fields now is optional, field value will be used by default

## 1.1.0 - 2017-10-03
- Add compatiblity for Laravel 5.5
