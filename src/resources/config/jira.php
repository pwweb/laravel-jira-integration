<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Jira Configurations
    |--------------------------------------------------------------------------
    |
    |
    */
    'host' => env('JIRA_HOST', ''),

    'user' => env('JIRA_USER', ''),

    'pass' => env('JIRA_PASS', ''),

    'logging' => [

        'enabled' => env('JIRA_LOG_ENABLED', true),

        'file' => env('JIRA_LOG_FILE', 'jira-connector.log'),

        'level' => env('JIRA_LOG_LEVEL', 'WARNING')
    ],

    'apiv3' => env('JIRA_REST_API_V3', false),
];
