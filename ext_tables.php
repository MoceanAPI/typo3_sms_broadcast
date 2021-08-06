<?php
defined('TYPO3_MODE') or die();

(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule(
        'moceanapi',
        '',
        '',
        '',
        [
            'name' => 'moceanapi',
            'icon' => 'EXT:mocean_api_broadcast/Resources/Public/Icons/Extension.svg',
            'labels' => 'LLL:EXT:mocean_api_broadcast/Resources/Private/Language/locallang.xlf',
            'standalone' => true,
        ]
    );
   
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'MoceanApiBroadcast',
        'moceanapi',
        'sms',
        '',
        [
            \Mocean\MoceanApiBroadcast\Controller\SmsController::class => 'index'
        ],
        [
            'name' => 'mocean_api_broadcast_sms',
            'icon' => 'EXT:mocean_api_broadcast/Resources/Public/Icons/actions-comment.svg',
            'labels' => 'LLL:EXT:mocean_api_broadcast/Resources/Private/Language/locallang_sms.xlf'
        ]
    ); 
   
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'MoceanApiBroadcast',
        'moceanapi',
        'history',
        '',
        [
            \Mocean\MoceanApiBroadcast\Controller\HistoryController::class => 'index, search, export'
        ],
        [
            'name' => 'mocean_api_broadcast_history',
            'icon' => 'EXT:mocean_api_broadcast/Resources/Public/Icons/actions-list-alternative.svg',
            'labels' => 'LLL:EXT:mocean_api_broadcast/Resources/Private/Language/locallang_history.xlf'
        ]
    );   
})();