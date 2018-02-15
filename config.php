<?php

return [
    'baseUrl' => '',
    'production' => false,
    'name' => 'Patrick Stephan',
    'collections' => [
    	'pages' => [
    		'path' => '{-filename}',
    		'sort' => 'sort_order',
            'extends' => '_layouts.page',
            'section' => 'body',
    	],
    	'posts' => [
            'type' => 'Blog Post',
    		'path' => 'post/{url}',
    		'sort' => 'date',
            'extends' => '_layouts.post',
            'section' => 'body',
    	],
        'packages' => [
            'path' => 'packages/{-filename}',
            'sort' => 'date',
        ],
        'tips' => [
            'type' => 'Quick Tip',
            'path' => 'tips/{-url}',
            'sort' => 'date',
            'extends' => '_layouts.post',
            'section' => 'body',
        ]
    ],
    'social' => [
        [
            'label' => 'Twitter',
            'icon' => 'twitter-square',
            'url' => 'https://www.twitter.com/pstephan1187'
        ],
        [
            'label' => 'LinkedIn',
            'icon' => 'linkedin-square',
            'url' => 'https://www.linkedin.com/in/pstephan1187/'
        ],
        [
            'label' => 'Stack Exchange',
            'icon' => 'stack-exchange',
            'url' => 'https://stackexchange.com/users/322609/patrick-stephan'
        ],
        [
            'label' => 'Github',
            'icon' => 'github-square',
            'url' => 'https://github.com/pstephan1187'
        ]
    ]
];
