<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Seo Data Table
    |--------------------------------------------------------------------------
    |
    | You can customize seo data storing table for your models
    */
    'seo_data_table' => 'seo_data',

    /*
    |--------------------------------------------------------------------------
    | Seo Data Templates Path
    |--------------------------------------------------------------------------
    |
    | Path to lang file where you can set property template
    |
    | Supported properties: "title", "description"
    */
    'templates_path' => 'seoable::seo',

    /*
    |--------------------------------------------------------------------------
    | Seo Data Model
    |--------------------------------------------------------------------------
    |
    | Model name for seo data table
    */
    'model' => \MadWeb\Seoable\Models\SeoData::class,
];
