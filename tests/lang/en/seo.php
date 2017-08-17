<?php

return [
    \MadWeb\Seoable\Test\Models\Post::class => [
        'title' => 'This is post :title',
        'description' => 'Description :description',
        'twitter_card' => [
            'title' => 'Title from twitter card :title',
            'description' => 'Twitter card description :description'
        ],
        'open_graph' => [
            'title' => 'Title from open_graph :title',
            'description' => 'OpenGraph description :description'
        ],
        'custom' => [
            'description' => 'Custom description :description'
        ]
    ]
];
