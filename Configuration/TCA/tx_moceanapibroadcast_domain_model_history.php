<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:mocean_api_broadcast/Resources/Private/Language/locallang_db.xlf:tx_moceanapibroadcast_domain_model_history',
        'label' => 'history',
        'iconfile' => 'EXT:mocean_api_broadcast/Resources/Public/Icons/Extension.svg',
        'hideTable' => 1
    ],
    'columns' => [
        'sender' => [
            'label' => 'LLL:EXT:mocean_api_broadcast/Resources/Private/Language/locallang_db.xlf:tx_moceanapibroadcast_domain_model_history.sender',
            'exclude' => 1,
			'config' => [
                'type' => 'none'
            ]
        ],
        'datetime' => [
            'label' => 'LLL:EXT:mocean_api_broadcast/Resources/Private/Language/locallang_db.xlf:tx_moceanapibroadcast_domain_model_history.datetime',
            'exclude' => 1,
			'config' => [
                'type' => 'none'
            ]
        ],
        'recipient' => [
            'label' => 'LLL:EXT:mocean_api_broadcast/Resources/Private/Language/locallang_db.xlf:tx_moceanapibroadcast_domain_model_history.recipient',
            'exclude' => 1,
			'config' => [
                'type' => 'none'
            ]
        ],
        'message' => [
            'label' => 'LLL:EXT:mocean_api_broadcast/Resources/Private/Language/locallang_db.xlf:tx_moceanapibroadcast_domain_model_history.message',
            'exclude' => 1,
			'config' => [
                'type' => 'none'
            ]
        ],
        'response' => [
            'label' => 'LLL:EXT:mocean_api_broadcast/Resources/Private/Language/locallang_db.xlf:tx_moceanapibroadcast_domain_model_history.response',
            'exclude' => 1,
			'config' => [
                'type' => 'none'
            ]
        ],
        'status' => [
            'label' => 'LLL:EXT:mocean_api_broadcast/Resources/Private/Language/locallang_db.xlf:tx_moceanapibroadcast_domain_model_history.status',
            'exclude' => 1,
			'config' => [
                'type' => 'none'
            ]
        ],
        'sms_log' => [
            'label' => 'LLL:EXT:mocean_api_broadcast/Resources/Private/Language/locallang_db.xlf:tx_moceanapibroadcast_domain_model_history.sms_log',
            'exclude' => 1,
			'config' => [
                'type' => 'none'
            ]
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'sender, datetime, recipient, message, response, status, sms_log']
    ]
];
