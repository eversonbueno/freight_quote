<?php

return [
    'modules' => [
        'Zend\Router',
    ],
    'module_listener_options' => [
        'config_glob_paths'    => [
            'config/autoload/{,*.}{global,local}.php',
        ],
        'config_cache_enabled' => false,
    ],
];
