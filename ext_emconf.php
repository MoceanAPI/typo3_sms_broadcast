<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'MoceanAPI Broadcast',
    'description' => 'MoceanAPI Broadcast module allows sending of text messages in bulk to frontend users',
    'category' => 'module',
    'author' => 'moceanapi',
    'author_company' => 'Micro Ocean Technologies',
    'author_email' => 'plugin@moceanapi.com',
    'state' => 'stable',
    'clearCacheOnLoad' => false,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
        ]
    ],
    'autoload' => [
        'psr-4' => [
            'Mocean\\MoceanApiBroadcast\\' => 'Classes'
        ]
    ]
];
