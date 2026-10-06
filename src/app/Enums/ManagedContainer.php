<?php

namespace App\Enums;

enum ManagedContainer: string
{
    case App = 'app';
    case Nginx = 'nginx';
    case MySql = 'mysql';
    case Reverb = 'reverb';
    case Redis = 'redis';
    case Meilisearch = 'meilisearch';
    case Queue = 'queue';
    case Scheduler = 'scheduler';
}
