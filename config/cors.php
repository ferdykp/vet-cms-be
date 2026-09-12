<?php

$origins = explode(',', (string) env(
    'CORS_ALLOWED_ORIGINS',
    env('FRONTEND_URL', 'http://localhost:3000')
));

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['GET', 'POST', 'OPTIONS'],
    'allowed_origins' => array_values(array_filter(array_map('trim', $origins))),
    'allowed_origins_patterns' => [],
    'allowed_headers' => [
        'Accept',
        'Content-Type',
        'Origin',
        'X-Requested-With',
    ],
    'exposed_headers' => [],
    'max_age' => 3600,
    'supports_credentials' => false,
];
