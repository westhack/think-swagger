<?php

return [
    'title' => 'Swagger-ui', // 标题
    'assets_path' => '/static/', // 静态资源目录
    'scan_dir' => [ // 扫描目录
        APP_PATH
    ],
    'scan_options' => [],
    'enable_cache' => false, // 是否开启缓存
    'cache_key' => 'api-swagger-cache', // 缓存key

    /* @see https://github.com/swagger-api/swagger-ui/blob/master/docs/usage/configuration.md */
    'configurations' => '', // json 格式
    'oauthConfiguration' => '' // json 格式
];