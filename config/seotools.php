<?php

return [
    'meta' => [
        'defaults' => [
            'title' => false,
            'description' => false,
            'separator' => ' - ',
            'keywords' => [],
            'canonical' => false, // Set null for using Url::current(), set false to total remove
        ],

        'webmaster_tags' => [
            'google' => null,
            'bing' => null,
            'alexa' => null,
            'pinterest' => null,
            'yandex' => null,
        ],
    ],
    'opengraph' => [
        'defaults' => [
            'title' => false,
            'description' => false,
            'url' => false, // Set null for using Url::current(), set false to total remove
            'type' => false,
            'site_name' => false,
            'images' => [],
        ],
    ],
    'twitter' => [
        'defaults' => [
          'card' => 'summary',
          'site' => '@CreadoresIndie',
        ],
    ],
];
