<?php
declare(strict_types = 1);

return [
    \Mocean\MoceanApiBroadcast\Domain\Model\User::class => [
        'tableName' => 'fe_users',
    ],
    \Mocean\MoceanApiBroadcast\Domain\Model\UserGroup::class => [
        'tableName' => 'fe_groups',
    ]
];
