<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'uri' => env('MONGODB_URI', 'mongodb://127.0.0.1:27017'),
    'connect_timeout' => env('MONGODB_CONNECT_TIMEOUT', '3s'),
    'read_write_timeout' => env('MONGODB_READ_WRITE_TIMEOUT', '60s'),
];
