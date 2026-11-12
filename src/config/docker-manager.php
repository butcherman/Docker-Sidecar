<?php

return [

    /*
    |---------------------------------------------------------------------------
    | Docker API
    |---------------------------------------------------------------------------
    */

    'docker' => [
        'socket' => env('DOCKER_SOCKET', '/var/run/docker.sock'),
        'api_version' => env('DOCKER_API_VERSION', 'v1.51'),
    ],

    /*
    |---------------------------------------------------------------------------
    | API Authentication
    |---------------------------------------------------------------------------
    |
    | This API Key will be used to authenticate all requests.
    |
    */

    'api_key' => env('DOCKER_MANAGER_API_KEY'),

    /*
    |---------------------------------------------------------------------------
    | Journal for Update Recovery
    |---------------------------------------------------------------------------
    |
    | This location will log updates to allow for recovery in the event of an
    | unexpected failure.
    |
    */

    'journal_path' => env(
        'DOCKER_MANAGER_JOURNAL_PATH',
        '/var/lib/docker-sidecar/update-journal'
    ),

    /*
    |--------------------------------------------------------------------------
    | Tech Bench Installation
    |--------------------------------------------------------------------------
    */

    'installation' => [
        'directory' => env('TECH_BENCH_INSTALL_DIR', '/opt/tech-bench'),
        'project_name' => env('TECH_BENCH_COMPOSE_PROJECT_NAME', 'tech-bench'),
        'compose_directory' => env('TECH_BENCH_COMPOSE_DIRECTORY', '/opt/tech-bench'),
    ],

    /*
    |---------------------------------------------------------------------------
    | Managed Containers
    |---------------------------------------------------------------------------
    |
    | List each container to be managed by this application here.
    |
    */

    'containers' => [
        'app' => [
            'name' => 'tech_bench',
            'display_name' => 'Tech Bench',
            'description' => 'Laravel application',
            'restartable' => false,
        ],

        'nginx' => [
            'name' => 'nginx',
            'display_name' => 'NGINX',
            'description' => 'Web server',
            'restartable' => true,
        ],

        'mysql' => [
            'name' => 'database',
            'display_name' => 'MySQL',
            'description' => 'Database server',
            'restartable' => true,
        ],

        'reverb' => [
            'name' => 'reverb',
            'display_name' => 'Reverb',
            'description' => 'Web socket engine',
            'restartable' => true,
        ],

        'redis' => [
            'name' => 'redis',
            'display_name' => 'Redis',
            'description' => 'Cache and queue backend',
            'restartable' => true,
        ],

        'meilisearch' => [
            'name' => 'meilisearch',
            'display_name' => 'Meilisearch',
            'description' => 'Search engine',
            'restartable' => true,
        ],

        'queue' => [
            'name' => 'horizon',
            'display_name' => 'Queue Worker',
            'description' => 'Queue worker',
            'restartable' => true,
        ],

        'scheduler' => [
            'name' => 'scheduler',
            'display_name' => 'Scheduler',
            'description' => 'Task Scheduler',
            'restartable' => true,
        ],
    ],
];
