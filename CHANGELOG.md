# Changelog

All Notable changes to `laravel-seoable` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## 3.0.0 - 2019-07-17

- Laravel 7.0 support
- Minimum required PHP version upped to 7.2.5
- Dropped support of 5.* Laravel versions

## 2.1.0 - 2019-09-23

- Laravel 6.0 support
- Minimum required PHP version upped to 7.2
- Dropped support of unsupported Laravel versions

## 2.0.0 - 2019-03-13
- Laravel 5.8 support
- Minimum requred php version upgraded to 7.1

## 1.2.2 - 2018-09-23
- Laravel 5.7 support

## 1.2.1 - 2018-08-04
- Replaced deprecated `setImages` method by `setImage`

## 1.2.0 - 2018-04-30
- Laravel 5.6 support
- `artesaos/seotools` main dependency upgraded to latest version
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
